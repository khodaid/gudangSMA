<?php

namespace App\Exports;

use App\Models\Keluar;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KeluarExport implements FromArray, WithHeadings
{
    protected $keluar = [];
    protected $dari, $sampai;

    public function __construct(String $dari, String $sampai)
    {
        $this->dari = $dari;
        $this->sampai = $sampai;
    }

    public function headings(): array
    {
        return [
            'Barang',
            'Jumlah',
            'Satuan',
            'Tanggal Pengeluaran',
            'Deskripsi'
        ];
    }

    /**
     * @return \Illuminate\Support\Array
     */
    public function array(): array
    {
        $keluar = Keluar::whereBetween('tgl_keluar', [$this->dari, $this->sampai])->get();
        foreach ($keluar as $k) {
            $this->keluar[] = [
                $k->barang->nama, $k->jumlah, $k->satuan->nama, date('d-m-Y', strtotime($k->tgl_keluar)), $k->deskripsi
            ];
        }
        return [$this->keluar];
    }
}
