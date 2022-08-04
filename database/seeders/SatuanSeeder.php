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
        $data = [
            [
                'nama' => 'Unit',
                'id_user' => 1
            ],
            [
                'nama' => 'Rim',
                'id_user' => 1
            ],
            [
                'nama' => 'Box',
                'id_user' => 1
            ],
            [
                'nama' => 'Lusin',
                'id_user' => 1
            ],
            [
                'nama' => 'Roll',
                'id_user' => 1
            ]
        ];
        Satuan::insert($data);
    }
}
