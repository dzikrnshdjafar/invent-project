<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::create([
            'name' => 'Gudang 1',
        ]);

        Room::create([
            'name' => 'Gudang 2',
        ]);

        Room::create([
            'name' => 'Gudang 3',
        ]);

        Room::create([
            'name' => 'Gudang 4',
        ]);

        Room::create([
            'name' => 'Gudang 5',
        ]);
    }
}
