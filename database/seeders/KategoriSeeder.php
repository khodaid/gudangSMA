<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama' => 'Inventaris',
                'id_user' => 1,
                'deskripsi' => 'Barang Non Habis'
            ],
            [
                'nama' => 'ATK',
                'id_user' => 1,
                'deskripsi' => 'Alat Tulis Kantor'
            ]
        ];
        Kategori::insert($data);
    }
}
