<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

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



    public function daftar()
    {
        $items = Item::paginate(8); // Ganti 8 dengan jumlah item per halaman yang Anda inginkan

        return view('pages.outer.daftar-barang', [
            "items" => $items
        ]);
    }
}
