<?php

namespace App\Http\Controllers;

use PDF;
use Mpdf\Mpdf;
use App\Models\Item;
use App\Models\Loan;
use App\Models\Room;
use App\Jobs\SendNotifd1;
use Illuminate\Http\Request;
use App\Jobs\SendLoanReminder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LoanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            $loans = Loan::with(['item' => function ($query) {
                $query->withTrashed();
            }, 'user'])->get();
        } else {
            $loans = Loan::with(['item' => function ($query) {
                $query->withTrashed();
            }, 'user'])
                ->where('user_id', $user->id)
                ->get();
        }

        $pendingLoansCount = Loan::where('status', 'pending')->count();

        return view('pages.inner.loans.index', compact('loans', 'pendingLoansCount'));
    }

    public function create()
    {
        // if (Gate::denies('Create Loans')) {
        //     abort(403);
        // }

        $items = Item::with('rooms')
            ->where('category', 'Bisa Dipinjamkan') // Filter items by category
            ->get()
            ->map(function ($item) {
                $item->available_quantity = $item->rooms->sum('pivot.quantity');
                return $item;
            });

        return view('pages.inner.loans.create', compact('items'));
    }

    public function store(Request $request)
    {
        // if (Gate::denies('Create Loans')) {
        //     abort(403);
        // }

        $request->validate([
            'item_id' => 'required|exists:items,id',
            'nama_peminjam' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nip_nik' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'keterangan' => 'nullable|string',
            'loan_duration' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = Item::with('rooms')->findOrFail($request->item_id);
        $availableQuantity = $item->rooms->sum('pivot.quantity');

        if ($request->quantity > $availableQuantity) {
            return redirect()->back()->with('error', 'Insufficient item quantity.');
        }

        $loan = Loan::create([
            'item_id' => $request->item_id,
            'user_id' => auth()->id(),
            'nama_peminjam' => $request->nama_peminjam,
            'alamat' => $request->alamat,
            'nip_nik' => $request->nip_nik,
            'no_hp' => $request->no_hp,
            'keterangan' => $request->keterangan,
            'loan_duration' => $request->loan_duration,
            'quantity' => $request->quantity,
            'status' => 'pending',  // Set default status as 'pending'
        ]);

        // // Ensure loan_duration is an integer
        // $loanDuration = intval($request->loan_duration);

        // dd($loan);

        // // Schedule WhatsApp reminder
        // SendLoanReminder::dispatch($loan)->delay(now()->addMinutes($loanDuration));

        return redirect()->route('loans.index')->with('success', 'Loan created successfully.');
    }

    public function show(Loan $loan)
    {
        return view('pages.inner.loans.show', compact('loan'));
    }

    public function edit(Loan $loan)
    {
        if (Gate::denies('Edit Loans')) {
            abort(403);
        }

        $items = Item::all();
        return view('pages.inner.loans.edit', compact('loan', 'items'));
    }

    public function update(Request $request, Loan $loan)
    {
        if (Gate::denies('Edit Loans')) {
            abort(403);
        }

        $request->validate([
            'item_id' => 'required|exists:items,id',
            'nama_peminjam' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nip_nik' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'keterangan' => 'nullable|string',
            'loan_duration' => 'nullable|integer|min:1',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:pending,dipinjam,dikembalikan',
        ]);

        $item = Item::with('rooms')->findOrFail($request->item_id);
        $availableQuantity = $item->rooms->sum('pivot.quantity');

        if ($request->quantity > $availableQuantity) {
            return redirect()->back()->with('error', 'Insufficient item quantity.');
        }

        $loan->update($request->all());

        return redirect()->route('loans.index')->with('success', 'Loan updated successfully.');
    }


    public function destroy(Loan $loan)
    {
        // Cek apakah pengguna memiliki izin untuk menghapus pinjaman
        if (Gate::denies('Delete Loans')) {
            abort(403);
        }

        // Cek apakah status pinjaman masih 'dipijman'
        if ($loan->status == 'dipinjam') {
            return redirect()->route('loans.index')->with('error', 'Loan cannot be deleted while it is still borrowed.');
        }

        // Lakukan penghapusan pinjaman
        $loan->delete();

        // Periksa apakah semua pinjaman untuk item ini telah dihapus
        $remainingLoans = Loan::where('item_id', $loan->item_id)->count();

        if ($remainingLoans == 0) {
            // Hapus permanen item jika sudah di-soft delete
            $item = Item::withTrashed()->find($loan->item_id);
            if ($item && $item->trashed()) {
                $item->forceDelete();
            }
        }

        return redirect()->route('loans.index')->with('success', 'Loan deleted successfully.');
    }


    public function manageQuantities(Loan $loan)
    {
        // $rooms = Room::whereHas('items', function ($query) use ($loan) {
        //     $query->where('item_id', $loan->item_id);
        // })->get();

        // Ambil item yang berhubungan dengan loan, beserta data rooms
        $item = $loan->item()->with('rooms')->first();

        // Ambil data loan_quantity dari tabel loans
        $loanQuantities = $loan->quantity;

        // Ambil rooms yang terkait dengan item ini
        $rooms = $item ? $item->rooms : collect();

        return view('pages.inner.loans.manage-quantities', compact('loan', 'rooms', 'loanQuantities'));
    }




    public function updateQuantities(Request $request, Loan $loan)
    {
        $request->validate([
            'quantities' => 'required|array',
            'quantities.*.room_id' => 'required|exists:rooms,id',
            'quantities.*.quantity' => 'nullable|integer|min:0',
        ]);

        $totalQuantity = array_sum(array_column($request->quantities, 'quantity'));

        if ($totalQuantity != $loan->quantity) {
            return redirect()->back()->with('warning', 'Total quantities do not match the loan quantity.');
        }

        // Update item_room quantities
        DB::transaction(function () use ($request, $loan) {
            foreach ($request->quantities as $quantityData) {
                if (isset($quantityData['quantity'])) {
                    $room = Room::find($quantityData['room_id']);
                    $room->items()->updateExistingPivot($loan->item_id, [
                        'quantity' => DB::raw('quantity - ' . $quantityData['quantity'])
                    ]);
                }
            }

            $loan->update(['status' => 'dipinjam']);
        });

        $loanDuration = $loan->loan_duration;

        // Schedule WhatsApp reminder
        SendNotifd1::dispatch($loan)->delay(now()->addMinutes($loanDuration - 1));
        SendLoanReminder::dispatch($loan)->delay(now()->addMinutes($loanDuration));

        return redirect()->route('loans.index')->with('success', 'Quantities successfully updated.');
    }


    public function returnItems(Request $request, Loan $loan)
    {
        if (Gate::denies('Return Items')) {
            abort(403);
        }

        $request->validate([
            'quantities' => 'required|array',
            'quantities.*.room_id' => 'required|exists:rooms,id',
            'quantities.*.quantity' => 'nullable|integer|min:0',
        ]);

        $totalReturnQuantity = 0;
        foreach ($request->quantities as $quantityData) {
            $totalReturnQuantity += isset($quantityData['quantity']) ? (int)$quantityData['quantity'] : 0;
        }

        // Check if the total returned quantity matches the loaned quantity
        if ($totalReturnQuantity != $loan->quantity) {
            return redirect()->back()->with('warning', 'Total quantities returned do not match the loan quantity.');
        }

        DB::transaction(function () use ($request, $loan) {
            foreach ($request->quantities as $quantityData) {
                if (isset($quantityData['quantity'])) {
                    $room = Room::find($quantityData['room_id']);
                    $room->items()->updateExistingPivot($loan->item_id, [
                        'quantity' => DB::raw('quantity + ' . $quantityData['quantity'])
                    ]);
                }
            }

            $loan->update(['status' => 'dikembalikan']);
            $loan->update(['return_date' => now()]);
        });

        return redirect()->route('loans.index')->with('success', 'Items returned successfully.');
    }


    public function returnItemsForm(Loan $loan)
    {
        if (Gate::denies('Return Items')) {
            abort(403);
        }

        // Load the rooms associated with the item being returned
        $rooms = Room::whereHas('items', function ($query) use ($loan) {
            $query->where('item_id', $loan->item_id);
        })->get();

        // Ambil data loan_quantity dari tabel loans
        $loanQuantities = $loan->quantity;


        return view('pages.inner.loans.return-items', compact('loan', 'rooms', 'loanQuantities'));
    }

    public function exportPDF()
    {
        $loans = Loan::with(['item' => function ($query) {
            $query->withTrashed();
        }, 'user'])->get();

        $html = view('pages.inner.loans.pdf', compact('loans'))->render();

        $mpdf = new Mpdf();

        $mpdf->WriteHTML($html);
        $mpdf->Output('loans.pdf', 'D'); // 'D' untuk download, bisa diganti dengan 'I' untuk inline

        exit;
    }
}
