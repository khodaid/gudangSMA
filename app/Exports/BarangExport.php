<?php

namespace App\Exports;

use App\Models\Barang;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\withHeadings;
use Illuminate\Http\Request;

class BarangExport implements FromArray, withHeadings
{
    protected $brg=[];
    protected $option;

    public function __construct(int $option)
    {
        $this->option = $option;
    }

    public function headings(): array
    {
        return [
            'Barang',
            'Jumlah',
            'Satuan',
            'Kategori'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $barang = new Barang();

        if ($this->option==1) {
            $barang = Barang::all();
        } elseif ($this->option==2) {
            $barang = Barang::where('kategori',1)->get();
        } else {
            $barang = Barang::where('kategori',0)->get();
        }



        // dd($barang);
        foreach($barang as $b)
        {
            $kategori = "Umum";
            $jumlah = 0;
            if ($b->kategori) {
                $kategori = "Inventaris";
            }
            else{
                $jumlah = $b->masuk->sum('jumlah') - $b->keluar->sum('jumlah');
            }
            $this->brg[] = [
                    $b->nama, number_format((float)$jumlah, 2, '.', ''), $b->satuan->nama, $kategori
                ];
        }

        // dd($this->brg);
        return [$this->brg];
    }
}
