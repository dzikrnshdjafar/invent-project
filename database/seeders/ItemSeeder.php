<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::create([
            'name' => 'Traktor',
            'room_id' => '1',
            'description' => 'aitakata',
            'quantity' => '2',
        ]);

        Item::create([
            'name' => 'Tangki',
            'room_id' => '2',
            'description' => 'hehe',
            'quantity' => '34',
        ]);

        Item::create([
            'name' => 'Gilingan Padi',
            'room_id' => '3',
            'description' => 'wakwaw',
            'quantity' => '1',
        ]);
    }
}
