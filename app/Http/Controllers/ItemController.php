<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use App\Models\Room;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        // Ambil semua item beserta relasinya
        $items = Item::with('rooms')->get();

        // Hitung total jumlah semua item dari tabel pivot
        $totalItems = $items->sum(function ($item) {
            return $item->rooms->sum('pivot.quantity');
        });

        // Hitung jumlah item yang dipinjam dari tabel loans
        $borrowedItems = Loan::where('status', 'borrowed')->sum('quantity');

        return view('pages.inner.items.index', compact('items', 'totalItems', 'borrowedItems'));
    }





    public function create()
    {
        $rooms = Room::all();
        return view('pages.inner.items.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'rooms' => 'required|array',
            'rooms.*.room_id' => 'required|exists:rooms,id',
            'rooms.*.quantity' => 'required|integer|min:1',
        ]);

        // Create the item
        $item = Item::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Attach the rooms with quantities
        foreach ($request->rooms as $room) {
            // Ensure only valid rooms with quantities are attached
            if (!empty($room['room_id']) && !empty($room['quantity'])) {
                $item->rooms()->attach($room['room_id'], ['quantity' => $room['quantity']]);
            }
        }

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }



    public function show(Item $item)
    {
        $item->load('rooms'); // Memuat relasi rooms

        return view('pages.inner.items.show', compact('item'));
    }


    public function edit(Item $item)
    {
        $rooms = Room::all();
        return view('pages.inner.items.edit', compact('item', 'rooms'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required',
            'rooms' => 'required|array',
            'rooms.*.room_id' => 'required|exists:rooms,id',
            'rooms.*.quantity' => 'required|integer|min:1',
        ]);

        // Update item details
        $item->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Detach all rooms
        $item->rooms()->detach();

        // Attach rooms with quantities
        foreach ($request->rooms as $room) {
            if (!empty($room['room_id']) && !empty($room['quantity'])) {
                $item->rooms()->attach($room['room_id'], ['quantity' => $room['quantity']]);
            }
        }

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }


    public function destroy(Item $item)
    {
        // Periksa apakah ada pinjaman dengan status 'borrowed' untuk item ini
        $pendingCheck = Loan::where('item_id', $item->id)
            ->where('status', 'pending')
            ->exists();

        if ($pendingCheck) {
            return redirect()->route('items.index')->with('error', 'The item cannot be deleted because it has a loan request.');
        }

        // Periksa apakah ada pinjaman dengan status 'borrowed' untuk item ini
        $loanExists = Loan::where('item_id', $item->id)
            ->where('status', 'borrowed')
            ->exists();

        if ($loanExists) {
            return redirect()->route('items.index')->with('error', 'Item cannot be deleted because it is currently borrowed.');
        }

        // Periksa apakah ada pinjaman dengan status 'returned' untuk item ini
        $returnedLoans = Loan::where('item_id', $item->id)
            ->where('status', 'returned')
            ->count();

        if ($returnedLoans > 0) {
            // Lakukan soft delete
            $item->delete();
            return redirect()->route('items.index')->with('success', 'Item has been soft deleted.');
        }

        // Hapus item secara permanen jika tidak ada pinjaman terkait
        $item->forceDelete();
        return redirect()->route('items.index')->with('success', 'Item has been permanently deleted.');
    }


    public function getRooms($itemId)
    {
        $item = Item::with('rooms')->findOrFail($itemId);
        $rooms = $item->rooms->map(function ($room) {
            return [
                'id' => $room->id,
                'name' => $room->name,
                'quantity' => $room->pivot->quantity,
            ];
        });

        return response()->json($rooms);
    }
}
