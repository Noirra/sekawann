<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KategoriModel>
 */
class KategoriModelFactory extends Factory
{
    protected $model = \App\Models\KategoriModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kategori_nama' => $this->faker->word(), // Contoh nama kategori acak
        ];
    }
}
