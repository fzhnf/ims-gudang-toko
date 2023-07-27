<?php

namespace Database\Factories;

use App\Models\Kategori;
use App\Models\Pemasok;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory {
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$kategoriIds = Kategori::pluck('id_kategori')->toArray();
		$pemasokIds = Pemasok::pluck('id_pemasok')->toArray();

		return [
			'nama_produk' => $this->faker->words(2, true),
			'quantity' => $this->faker->randomNumber(2),
			'harga_per_pcs' => $this->faker->numberBetween($min = 1500, $max = 6000),
			'kategori_id' => function () use ($kategoriIds) {
				return $this->faker->randomElement($kategoriIds);
			},
			'pemasok_id' => function () use ($pemasokIds) {
				return $this->faker->randomElement($pemasokIds);
			},
		];
	}
}
