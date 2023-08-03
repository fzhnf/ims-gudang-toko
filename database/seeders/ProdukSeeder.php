<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\Produk::factory(20)->create();
        // There is no need to set the nama_kategori attribute, you can access it directly from the relationship
        $produksWithKategoriAndPemasok = Produk::with('kategori', 'pemasok')->get();

        // Menampilkan informasi produk beserta informasi kategori
        // Pindah ke controller iz
        foreach ($produksWithKategoriAndPemasok as $produk) {
            $nama_produk = $produk->nama_produk;
            $quantity = $produk->quantity;
            $harga_per_pcs = $produk->harga_per_pcs;
            $nama_kategori = $produk->kategori->nama_kategori;
            $nama_pemasok = $produk->pemasok->nama_pemasok;

            echo "Nama Produk: " . $nama_produk . ", ";
            echo "Quantity: " . $quantity . ", ";
            echo "Harga per pcs: " . $harga_per_pcs . ", ";
            echo "Nama Kategori: " . $nama_kategori . ", ";
            echo "Nama Pemasok: " . $nama_pemasok . "\n ";
        }
    }
}
