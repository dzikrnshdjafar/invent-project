<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $rooms = Room::with('items')->get();

        // Prepare data for chart
        $categories = $rooms->pluck('name');
        $series = $rooms->map(function ($room) {
            return $room->items->sum('quantity');
        });

        // Prepare data for the chart component
        $charts = [
            'commodity_each_location_count' => [
                'series' => $series,
                'categories' => $categories,
            ]
        ];

        return view('dashboard', [
            'charts' => $charts
        ]);
    }
}
