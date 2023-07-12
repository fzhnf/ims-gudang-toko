<?php

namespace Database\Seeders;


use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    
    protected $table = 'kategori';

    public function run(): void
    {
        Kategori::factory()
            ->count(5)
            ->create();
    }
}
