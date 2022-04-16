<?php

namespace Database\Seeders;

use App\Models\Satuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1,20) as $i)
        {
            $resultIds= Satuan::factory()->create();

            $data = [
                [
                    'nama' => $resultIds->nama,
                    'id_user' => $resultIds->id_user
                ]
            ];
        }
        Satuan::insert($data);
    }
}
