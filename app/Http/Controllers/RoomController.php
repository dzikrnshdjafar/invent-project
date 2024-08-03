<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('items')->get();

        // Add total quantity for each room
        foreach ($rooms as $room) {
            $room->total_quantity = $room->items->sum('quantity');
        }

        return view('pages.inner.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('pages.inner.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Room::create($request->all());

        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    public function show(Room $room)
    {
        return view('pages.inner.rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('pages.inner.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $room->update($request->all());

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
}
