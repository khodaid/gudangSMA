<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
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
                'nama' => 'Kertas Sidu F4 70gr',
                'kode_barang' => 'K-SD-F4-70',
                'id_user' => 2,
                'id_satuan' => 2,
                'id_kategori' => 2
            ],
            [
                'nama' => 'Kertas Sidu A4 70gr',
                'kode_barang' => 'K-SD-A4-70',
                'id_user' => 2,
                'id_satuan' => 2,
                'id_kategori' => 2
            ],
            [
                'nama' => 'Komputer Acer',
                'kode_barang' => 'KP-Acer',
                'id_user' => 2,
                'id_satuan' => 1,
                'id_kategori' => 1
            ],
            [
                'nama' => 'Bulpoin Standart Hitam',
                'kode_barang' => 'B-Standart-H',
                'id_user' => 2,
                'id_satuan' => 3,
                'id_kategori' => 2
            ],
        ];
        Barang::insert($data);
    }
}
