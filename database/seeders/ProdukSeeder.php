<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

<<<<<<<< HEAD:database/seeders/PemasokSeeder.php
class PemasokSeeder extends Seeder
========
class ProdukSeeder extends Seeder
>>>>>>>> dev/produk/be/han:database/seeders/ProdukSeeder.php
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<<< HEAD:database/seeders/PemasokSeeder.php
        \App\Models\Pemasok::factory(5)->create();
========
        \App\Models\Produk::factory(20)->create();
>>>>>>>> dev/produk/be/han:database/seeders/ProdukSeeder.php
    }
}
