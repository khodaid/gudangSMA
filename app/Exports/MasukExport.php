<?php

namespace App\Exports;

use App\Models\Masuk;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpParser\Node\Expr\Cast\String_;

class MasukExport implements FromArray, WithHeadings
{
    protected $masuk = [];
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
            'Tanggal Pembelian',
            'Tanggal Penerimaan',
            'Deskripsi',
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
        $masuks = Masuk::whereBetween('tgl_penerimaan',[$this->dari, $this->sampai])->get();
        foreach ($masuks as $m) {
            $this->masuk[] = [
                $m->barang->nama, $m->jumlah, $m->satuan->nama, date('d-m-Y', strtotime($m->tgl_pemesanan)),
                date('d-m-Y', strtotime($m->tgl_penerimaan)), $m->deskripsi, $m->nama_toko,
                $m->harga_satuan, $m->jumlah_harga
            ];
        }
        return [$this->masuk];
    }
}
