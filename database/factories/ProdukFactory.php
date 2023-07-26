<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_produk' => fake()->words(2, true),
            'quantity' => fake()->randomNumber(2),
            'harga_per_pcs' => fake()->numberBetween($min = 1500, $max = 6000),
        ];
    }
}
