<?php

namespace App\Exports;

use App\Models\Keluar;
use Maatwebsite\Excel\Concerns\FromCollection;

class KeluarExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Keluar::all();
    }
}
