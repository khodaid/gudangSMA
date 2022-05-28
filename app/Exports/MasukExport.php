<?php

namespace App\Exports;

use App\Models\Masuk;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\withHeadings;

class MasukExport implements FromArray, withHeadings
{
    protected $masuk = [];

    public function headings(): array
    {
        return [
            'Barang',
            'Jumlah',
            'Satuan',
            'Tanggal Pembelian',
            'Tanggal Penerimaan',
            'Nama Toko',
            'Harga Satuan',
            'Harga Total'
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        $masuks = Masuk::all();
        foreach ($masuks as $m) {
            $this->masuk[] = [
                $m->barang->nama, $m->jumlah, $m->satuan->nama, $m->tgl_pemesanan, $m->tgl_penerimaan, $m->nama_toko, $m->harga_satuan, $m->jumlah_harga
            ];
        }
        return [$this->masuk];
    }
}
