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

        return view('layouts.outer.landing-page', [
            "title" => "Data Daerah Irigasi",
            "items" => $items,
            "totalItems" => $totalItems,
        ]);
    }
}
