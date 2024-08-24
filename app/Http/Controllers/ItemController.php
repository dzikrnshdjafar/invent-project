<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // Validasi input
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'condition' => 'required|string',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'rooms' => 'required|array',
            'rooms.*.room_id' => 'required|exists:rooms,id',
            'rooms.*.quantity' => 'required|integer|min:1',
        ]);

        // Generate a new item with an auto-increment ID
        $lastItem = Item::orderBy('id')->first();
        $newId = $lastItem ? $lastItem->id + 1 : 1;

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Simpan file gambar ke folder 'public/images'
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Simpan item dengan path gambar
        $item = Item::create([
            'id' => $newId,
            'name' => $request->name,
            'description' => $request->description,
            'condition' => $request->condition,
            'category' => $request->category,
            'image' => $imagePath, // Simpan path gambar ke database
        ]);

        // Lampirkan ruangan dengan jumlahnya
        foreach ($request->rooms as $room) {
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
        ]);

        // Jika ada gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage jika ada
            if ($item->image) {
                Storage::delete('public/' . $item->image);
            }

            // Simpan gambar baru dan ambil path-nya
            $imagePath = $request->file('image')->store('images', 'public');

            // Update item dengan gambar baru
            $item->update([
                'name' => $request->name,
                'description' => $request->description,
                'condition' => $request->condition,
                'category' => $request->category,
                'image' => $imagePath, // Simpan path gambar baru
            ]);
        } else {
            // Update item tanpa mengganti gambar
            $item->update([
                'name' => $request->name,
                'description' => $request->description,
                'condition' => $request->condition,
                'category' => $request->category,
            ]);
        }

        // Detach semua rooms
        $item->rooms()->detach();

        // Attach rooms dengan quantity yang baru
        foreach ($request->rooms as $room) {
            if (!empty($room['room_id']) && !empty($room['quantity'])) {
                $item->rooms()->attach($room['room_id'], ['quantity' => $room['quantity']]);
            }
        }

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }



    public function destroy(Item $item)
    {
        // Periksa apakah ada pinjaman dengan status 'pending' untuk item ini
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

        // Hapus gambar dari storage jika ada
        if ($item->image) {
            Storage::delete('public/' . $item->image);
        }

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
