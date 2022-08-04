<?php

namespace Database\Seeders;

use App\Models\Satuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(5)->create();
        // $this->call([
        //     SatuanSeeder::class
        // ]);
        // \App\Models\User::factory()->create();
        $this->call([
            UserSeeder::class,
            LokasiSeeder::class,
            SatuanSeeder::class,
            KategoriSeeder::class,
            BarangSeeder::class
        ]);
    }
}
