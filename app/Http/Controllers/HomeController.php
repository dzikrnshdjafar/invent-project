<?php

// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Room;
use App\Models\Loan;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $itemQuantitiesByRoom = Room::select('name as room_name', DB::raw('SUM(item_room.quantity) as total_quantity'))
            ->join('item_room', 'rooms.id', '=', 'item_room.room_id')
            ->groupBy('rooms.name')
            ->get();

        $pendingLoansCount = Loan::where('status', 'pending')->count();

        // Generate unique colors for each room
        $barColors = [
            '#FFB3B3', // Soft Red
            '#FFCCB3', // Soft Orange
            '#FFEB99', // Soft Yellow
            '#D9EAD3', // Soft Green
            '#C2C2F0', // Soft Blue
            '#EAD1DC', // Soft Pink
            '#F0E6F6', // Soft Lavender
            '#D5A6A2', // Soft Coral
            '#F9CB9C', // Soft Peach
            '#C4E17F', // Soft Lime
            '#B6D7A8', // Soft Olive
            '#CFE2F3', // Soft Sky Blue
            '#EAD1DC', // Soft Rose
            '#F5A9B8', // Soft Salmon
            '#F4CCCC', // Soft Cream
            '#E2B5A0', // Soft Tan
            '#D0E0E3', // Soft Steel Blue
            '#D5A6A2', // Soft Clay
            '#C4E17F', // Soft Chartreuse
            '#C1D3F3', // Soft Periwinkle
            '#E6B8AF', // Soft Blush
        ];

        $charts = [
            'items_each_rooms_count' => [
                'series' => $itemQuantitiesByRoom->pluck('total_quantity')->toArray(),
                'labels' => $itemQuantitiesByRoom->pluck('room_name')->toArray(),
                'colors' => array_slice($barColors, 0, $itemQuantitiesByRoom->count()), // Slice to match the number of rooms
            ],
        ];

        $totalItems = Item::count();
        $totalRooms = Room::count();
        $totalLoans = Loan::count();

        return view('dashboard', compact('charts', 'pendingLoansCount', 'totalItems', 'totalRooms', 'totalLoans'));
    }
}
