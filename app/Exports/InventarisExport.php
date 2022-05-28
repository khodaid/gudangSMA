<?php

namespace App\Exports;

use App\Models\Inventaris;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\withHeadings;

class InventarisExport implements FromArray, withHeadings
{
    protected $inventaris = [];
    protected $dari, $sampai;

    public function __construct(String $dari, String $sampai)
    {
        $this->dari = $dari;
        $this->sampai = $sampai;
    }

    public function headings(): array
    {
        return [
            'Tanngal Pembukuan',
            'Kode',
            'Barang',
            'Deskripsi',
            'Jumlah',
            'Satuan',
            'Asal Dana',
            'Tahun Pembuatan',
            'Tanggal Penyerahan',
            'Kondisi',
            'Harga'
        ];
    }

    /**
     * @return \Illuminate\Support\Array
     */
    public function array(): array
    {
        $inventaris = Inventaris::whereBetween('tgl_pembukuan', [$this->dari, $this->sampai])->get();

        foreach ($inventaris as $i) {
            $kondisi = "Baik";
            if ($i->kondisi == 2) {
                $kondisi = "Rusak Ringan";
            } elseif ($i->kondisi == 3) {
                $kondisi = "Rusak Berat";
            }
            $this->inventaris[] = [
                date('d-m-Y', strtotime($i->tgl_pembukuan)), $i->kode, $i->barang->nama, $i->deskripsi,
                $i->jumlah, $i->satuan->nama, $i->dana->nama, $i->thn_pembuatan, date('d-m-Y', strtotime($i->tgl_penyerahan)), $kondisi, $i->harga
            ];
        }
        return [$this->inventaris];
    }
}
