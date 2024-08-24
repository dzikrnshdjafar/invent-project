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
        $itemNames = [
            'Traktor',
            'Cangkul',
            'Sekop',
            'Garu',
            'Sabit',
            'Parang',
            'Gunting tanaman',
            'Mesin pemotong rumput',
            'Penyemprot hama',
            'Pupuk organik',
            'Pupuk kimia',
            'Pestisida',
            'Insektisida',
            'Fungisida',
            'Benih padi',
            'Benih jagung',
            'Benih kacang-kacangan',
            'Benih sayuran',
            'Benih buah-buahan',
            'Bibit tanaman keras',
            'Bibit tanaman tahunan',
            'Bibit tanaman hias',
            'Bibit tanaman obat',
            'Pot tanaman',
            'Polybag',
            'Ajir bambu',
            'Tali rafia',
            'Jaring penghalang hama',
            'Mulsa plastik',
            'Plastik UV',
            'Sistem irigasi tetes',
            'Selang air',
            'Pompa air',
            'Tangki air',
            'Keranjang panen',
            'Alat pemanen',
            'Mesin penggiling padi',
            'Mesin penanam padi',
            'Mesin pemanen jagung',
            'Mesin penyemprot pestisida',
            'Truk angkut hasil panen',
            'Gudang penyimpanan',
            'Kain penutup tanaman',
            'Jaring peneduh',
            'Mesin pemipil jagung',
            'Alat pengukur pH tanah',
            'Alat pengukur kelembapan tanah',
            'Thermometer tanah',
            'Sprayer elektrik',
            'Bibit tanaman hidroponik',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($itemNames),
            'description' => $this->faker->sentence,
            'condition' => null,
            'category' => null,
            'image' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
