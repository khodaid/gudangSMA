<?php

namespace App\Exports;

use App\Models\Barang;
use App\Models\Inventaris;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BarangExport implements FromArray, withHeadings
{
    protected $brg = [];
    protected $option;

    public function __construct(int $option)
    {
        $this->option = $option;
    }

    public function headings(): array
    {
        return [
            'Barang',
            'Kode',
            'Jumlah',
            'Satuan',
            'Kategori'
        ];
    }
    /**
     * @return \Illuminate\Support\Array
     */
    public function array(): array
    {
        // $barang = new Barang();
        $akun = User::where('id_super', Auth::id())->get();

        if ($this->option == 0) {
            $barang = Barang::where('barangs.id_user', Auth::id())
                ->orWhereIn('barangs.id_user', $akun->modelKeys())
                ->leftJoin('keluars', 'barangs.id', '=', 'keluars.id_barang')
                ->leftJoin('masuks', 'barangs.id', '=', 'masuks.id_barang')
                ->select('barangs.nama', 'barangs.id', 'barangs.id_satuan', 'barangs.id_kategori', 'barangs.kode_barang', DB::raw('ifnull(sum(masuks.jumlah),0) - ifnull(sum(keluars.jumlah),0) as jumlah'))
                ->groupBy('barangs.nama', 'barangs.id', 'barangs.id_satuan', 'barangs.id_kategori', 'barangs.kode_barang')
                ->with(['satuan', 'kategori', 'inventaris'])
                ->get();
            foreach ($barang as $b) {
                if ($b->id_kategori == 1) {
                    $this->brg[] = [
                        $b->nama, $b->kode_barang, number_format((float)$b->inventaris->count(), 2, '.', ''), $b->satuan->nama, $b->kategori->nama
                    ];
                    continue;
                }
                $this->brg[] = [
                    $b->nama, $b->kode_barang, number_format((float)$b->jumlah, 2, '.', ''), $b->satuan->nama, $b->kategori->nama
                ];
            }
            return [$this->brg];
        } else if ($this->option > 1) {
            $barang = Barang::where('id_kategori', $this->option)
                ->where('barangs.id_user', Auth::id())
                ->orWhereIn('barangs.id_user', $akun->modelKeys())
                ->leftJoin('keluars', 'barangs.id', '=', 'keluars.id_barang')
                ->leftJoin('masuks', 'barangs.id', '=', 'masuks.id_barang')
                ->select('barangs.nama', 'barangs.id', 'barangs.id_satuan', 'barangs.id_kategori', 'barangs.kode_barang', DB::raw('ifnull(sum(masuks.jumlah),0) - ifnull(sum(keluars.jumlah),0) as jumlah'))
                ->groupBy('barangs.nama', 'barangs.id', 'barangs.id_satuan', 'barangs.id_kategori', 'barangs.kode_barang')
                ->with(['satuan', 'kategori'])
                ->get();
            // dd($barang);

            foreach ($barang as $b) {
                $this->brg[] = [
                    $b->nama, $b->kode_barang, number_format((float)$b->jumlah, 2, '.', ''), $b->satuan->nama, $b->kategori->nama
                ];
            }
            return [$this->brg];
        } else {
            $barang = Barang::where('id_kategori', $this->option)
                ->where('barangs.id_user', Auth::id())
                ->orWhereIn('barangs.id_user', $akun->modelKeys())
                ->with(['satuan', 'kategori', 'inventaris'])
                ->get();
            foreach ($barang as $b) {
                $this->brg[] = [
                    $b->nama, $b->kode_barang, number_format((float)$b->inventaris->count(), 2, '.', ''), $b->satuan->nama, $b->kategori->nama
                ];
            }
            return [$this->brg];
        }
    }
}
