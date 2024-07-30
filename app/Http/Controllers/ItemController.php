<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Room;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $rooms = Room::all();
        return view('items.create', compact('rooms'));
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
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $rooms = Room::all();
        return view('items.edit', compact('item', 'rooms'));
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
