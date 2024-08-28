<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ItemRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ambil semua ID dari rooms dan items
        $roomIds = Room::pluck('id')->toArray();
        $itemIds = Item::pluck('id')->toArray();

        foreach ($itemIds as $itemId) {
            // Pilih beberapa ruangan untuk setiap item
            $roomSubset = $faker->randomElements($roomIds, $faker->numberBetween(1, 2));

            foreach ($roomSubset as $roomId) {
                // Asosiasikan setiap item dengan beberapa ruangan
                DB::table('item_room')->insert([
                    'item_id' => $itemId,
                    'room_id' => $roomId,
                    'quantity' => $faker->numberBetween(1, 10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
