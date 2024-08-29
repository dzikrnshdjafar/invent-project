<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OuterController extends Controller
{
    public function index()
    {
        $items = Item::all();

        // Hitung total jumlah semua item dari tabel pivot
        $totalItems = $items->sum(function ($item) {
            return $item->rooms->sum('pivot.quantity');
        });

        $goodItemsCount = Item::where('condition', 'Baik')->count();
        $restoreItemsCount = Item::where('condition', 'Dalam Perbaikan')->count();
        $damagedItemsCount = Item::where('condition', 'Rusak')->count();



        return view('pages.outer.landing-page', [
            "title" => "Data Daerah Irigasi",
            "items" => $items,
            "itemsBaik" => $goodItemsCount,
            "itemsDalamPerbaikan" => $restoreItemsCount,
            "itemsRusak" => $damagedItemsCount,
            "totalItems" => $totalItems,
        ]);
    }



    public function daftar(Request $request)
    {
        $search = $request->input('search');

        // Lakukan pencarian berdasarkan nama barang
        $query = Item::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $items = $query->paginate(8);

        return view('pages.outer.daftar-barang', [
            "items" => $items,
            "search" => $search
        ]);
    }
}
