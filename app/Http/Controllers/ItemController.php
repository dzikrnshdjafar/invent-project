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
        $items = Item::all();
        $totalItems = Item::sum('quantity');
        $borrowedItems = Loan::where('status', 'borrowed')->sum('quantity');
        $availableItems = $totalItems - $borrowedItems;

        return view('pages.inner.items.index', compact('items', 'totalItems', 'borrowedItems', 'availableItems'));
    }

    public function create()
    {
        $rooms = Room::all();
        return view('pages.inner.items.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'room_id' => 'required|exists:rooms,id',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function show(Item $item)
    {
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
            'quantity' => 'required|integer',
            'room_id' => 'required|exists:rooms,id',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully.');
    }
}
