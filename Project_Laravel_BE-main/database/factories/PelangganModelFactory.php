<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PelangganModel>
 */
class PelangganModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\PelangganModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pelanggan_nama' => $this->faker->name(),
            'pelanggan_alamat' => $this->faker->address(),
            'pelanggan_notelp' => $this->faker->phoneNumber(),
            'pelanggan_email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
