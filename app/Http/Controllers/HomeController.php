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
        $barColors = $this->generateUniqueColors($itemQuantitiesByRoom->count());

        $charts = [
            'items_each_rooms_count' => [
                'series' => $itemQuantitiesByRoom->pluck('total_quantity')->toArray(),
                'labels' => $itemQuantitiesByRoom->pluck('room_name')->toArray(),
                'colors' => $barColors, // Use generated colors
            ],
        ];

        $totalItems = Item::count();
        $totalRooms = Room::count();
        $totalLoans = Loan::count();

        return view('dashboard', compact('charts', 'pendingLoansCount', 'totalItems', 'totalRooms', 'totalLoans'));
    }

    /**
     * Generate an array of unique colors.
     *
     * @param int $count Number of colors needed.
     * @return array
     */
    private function generateUniqueColors($count)
    {
        $colors = [];
        for ($i = 0; $i < $count; $i++) {
            $colors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        }
        return $colors;
    }
}
