<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 */
	public function run(): void {

		// $kategoriIds = Kategori::pluck('id_kategori')->toArray();
		// $pemasokIds = Pemasok::pluck('id_pemasok')->toArray();

		\App\Models\Produk::factory(20)->create();
		// There is no need to set the nama_kategori attribute, you can access it directly from the relationship
		foreach ($produk as $item) {
			$nama_kategori = $item->kategori->nama_kategori;
			echo "Nama Kategori: " . $nama_kategori . PHP_EOL;
		}
		// [
		// 'kategori_id' => function () use ($kategoriIds) {
		// 	return $this->faker->randomElement($kategoriIds);
		// },
		// 'pemasok_id' => function () use ($pemasokIds) {
		// 	return $this->faker->randomElement($pemasokIds);
		// }]);
	}
}
