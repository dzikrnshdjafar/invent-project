<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Traktor',
                'Bajak',
                'Pemotong Padi',
                'Cangkul',
                'Sekop',
                'Penyiram Tanaman',
                'Garpu Kebun',
                'Penanam Benih',
                'Kultivator',
                'Sistem Irigasi',
                'Pupuk',
                'Pestisida',
                'Rumah Kaca',
                'Pengompos',
                'Penyiang',
                'Garpu Taman',
                'Gunting Pemangkas',
                'Pot Tanaman',
                'Penyiram'
            ]),
            'room_id' => $this->faker->numberBetween(1, 4),
            'description' => $this->faker->sentence,
            'quantity' => $this->faker->numberBetween(1, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
