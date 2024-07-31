<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LoanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Check if the user is an admin
        if ($user->hasRole('Admin')) {
            $loans = Loan::with('item', 'user')->get();
        } else {
            // Filter loans based on the logged-in user for non-admin users
            $loans = Loan::with('item', 'user')
                ->where('user_id', $user->id)
                ->get();
        }

        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        if (Gate::denies('Create Loans')) {
            abort(403);
        }

        $items = Item::all();
        return view('loans.create', compact('items'));
    }

    public function store(Request $request)
    {
        if (Gate::denies('Create Loans')) {
            abort(403);
        }

        $request->validate([
            'item_id' => 'required|exists:items,id',
        ]);

        Loan::create([
            'item_id' => $request->item_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('loans.index')->with('success', 'Loan created successfully.');
    }

    public function show(Loan $loan)
    {
        return view('loans.show', compact('loan'));
    }

    public function edit(Loan $loan)
    {
        if (Gate::denies('Edit Loans')) {
            abort(403);
        }

        $items = Item::all();
        return view('loans.edit', compact('loan', 'items'));
    }

    public function update(Request $request, Loan $loan)
    {
        if (Gate::denies('Edit Loans')) {
            abort(403);
        }

        $request->validate([
            'item_id' => 'required|exists:items,id',
            'return_date' => 'nullable|date',
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
        $loan->update([
            'return_date' => now(),
            'status' => 'returned',
        ]);

        return redirect()->route('loans.index')->with('success', 'Item returned successfully.');
    }
}
