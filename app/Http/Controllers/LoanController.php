<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;
use App\Jobs\SendLoanReminder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LoanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            $loans = Loan::with('item', 'user')->get();
        } else {
            $loans = Loan::with('item', 'user')
                ->where('user_id', $user->id)
                ->get();
        }

        return view('pages.inner.loans.index', compact('loans'));
    }

    public function create()
    {
        if (Gate::denies('Create Loans')) {
            abort(403);
        }

        $items = Item::all();
        return view('pages.inner.loans.create', compact('items'));
    }

    public function store(Request $request)
    {
        if (Gate::denies('Create Loans')) {
            abort(403);
        }

        $request->validate([
            'item_id' => 'required|exists:items,id',
            'loan_duration' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = Item::find($request->item_id);

        if ($item->quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Insufficient item quantity.');
        }

        $item->decrement('quantity', $request->quantity);

        $loan = Loan::create([
            'item_id' => $request->item_id,
            'user_id' => auth()->id(),
            'loan_duration' => $request->loan_duration,
            'quantity' => $request->quantity,
            'status' => 'borrowed',
        ]);

        // Ensure loan_duration is an integer
        $loanDuration = intval($request->loan_duration);

        // Schedule WhatsApp reminder
        SendLoanReminder::dispatch($loan)->delay(now()->addMinutes($loanDuration));

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
            'loan_duration' => 'nullable|integer|min:1',
            'status' => 'required|in:borrowed,returned',
        ]);

        $loan->update($request->all());

        return redirect()->route('loans.index')->with('success', 'Loan updated successfully.');
    }

    public function destroy(Loan $loan)
    {
        if (Gate::denies('Delete Loans')) {
            abort(403);
        }

        $loan->delete();

        return redirect()->route('loans.index')->with('success', 'Loan deleted successfully.');
    }

    public function returnItem(Loan $loan)
    {
        if (Gate::denies('Return Items')) {
            abort(403);
        }

        $loan->update([
            'return_date' => now(),
            'status' => 'returned',
        ]);

        $item = $loan->item;
        $item->increment('quantity', $loan->quantity);

        return redirect()->route('loans.index')->with('success', 'Item returned successfully.');
    }
}
