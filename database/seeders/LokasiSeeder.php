<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
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
                'nama_lokasi' => "TU",
                'deskripsi' => "Ruang Tata Usaha",
                'id_user' => 1
            ],
            [
                'nama_lokasi' => "Masjid",
                'deskripsi' => "Masjid",
                'id_user' => 1
            ],
            [
                'nama_lokasi' => "Gudang ATK",
                'deskripsi' => "Ruang Gudang Alat Tulis Kantor",
                'id_user' => 1
            ],
            [
                'nama_lokasi' => "Gudang Inventaris",
                'deskripsi' => "Ruang Gudang Inventaris",
                'id_user' => 1
            ],
        ];
        Lokasi::insert($data);
    }
}
