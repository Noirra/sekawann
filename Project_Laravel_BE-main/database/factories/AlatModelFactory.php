<?php

namespace Database\Factories;

use App\Models\AlatModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlatModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'alat_nama' => $this->faker->word,
            'alat_kategori_id' => 1,
            'alat_deskripsi' => $this->faker->sentence,
            'alat_hargaperhari' => $this->faker->numberBetween(1000, 5000),
            'alat_stok' => $this->faker->numberBetween(5, 20),
        ];
    }
}
