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
        $barColors = ['#FF5733', '#33FF57', '#3357FF', '#F333FF', '#FF33A1', '#33FFF6', '#FFB833'];

        $charts = [
            'items_each_rooms_count' => [
                'series' => [
                    ['name' => 'Total Quantity', 'data' => $itemQuantitiesByRoom->pluck('total_quantity')->toArray()],
                ],
                'categories' => $itemQuantitiesByRoom->pluck('room_name')->toArray(),
                'colors' => array_slice($barColors, 0, $itemQuantitiesByRoom->count()), // Slice to match the number of rooms
            ],
        ];

        $totalItems = Item::count();
        $totalRooms = Room::count();
        $totalLoans = Loan::count();

        return view('dashboard', compact('charts', 'pendingLoansCount', 'totalItems', 'totalRooms', 'totalLoans'));
    }
}
