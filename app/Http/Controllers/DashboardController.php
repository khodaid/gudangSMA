<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Inventaris;
use App\Models\Masuk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $idUmumHabis = [];
    protected $idUmumMenipis = [];
    // protected $akun;

    public function index()
    {
        $akun = User::where('id_super', Auth::id())->get();
        // dd($akun);

        $rusakRingan = Inventaris::where('kondisi', 2)
            ->with('barang', 'satuan', 'dana')
            ->get();
        $rusakBerat =  Inventaris::where('kondisi', 3)
            ->with('barang', 'satuan', 'dana')
            ->get();

        $barangMenipis = Barang::where('barangs.id_kategori', '>', 1)
            ->where(function ($query) use ($akun) {
                $query->where('barangs.id_user', Auth::id())
                    ->orWhereIn('barangs.id_user', $akun->modelKeys());
            })
            ->leftJoin('masuks', 'masuks.id_barang', '=', 'barangs.id')
            ->leftJoin('keluars', 'keluars.id_barang', '=', 'barangs.id')
            ->select('barangs.id', 'barangs.nama', 'barangs.id_satuan', DB::raw('ifnull(sum(masuks.jumlah),0) - ifnull(sum(keluars.jumlah),0) as jumlah'))
            ->groupBy('barangs.id', 'barangs.nama', 'barangs.id_satuan')
            ->havingBetween('jumlah', [1, 10])
            ->with('satuan')
            ->get();

        $barangHabis = Barang::where('barangs.id_kategori', '>', 1)
            ->where(function ($query) use ($akun) {
                $query->where('barangs.id_user', Auth::id())
                    ->orWhereIn('barangs.id_user', $akun->modelKeys());
            })
            ->leftJoin('masuks', 'masuks.id_barang', '=', 'barangs.id')
            ->leftJoin('keluars', 'keluars.id_barang', '=', 'barangs.id')
            ->select('barangs.id', 'barangs.nama', 'barangs.id_satuan', DB::raw('ifnull(sum(masuks.jumlah),0) - ifnull(sum(keluars.jumlah),0) as jumlah'))
            ->groupBy('barangs.id', 'barangs.nama', 'barangs.id_satuan')
            ->having('jumlah', '=', 0)
            ->with('satuan')
            ->get();

        return view('admin.dashboard', [
            'habis' => $barangHabis,
            'menipis' => $barangMenipis,
            'ringan' => $rusakRingan,
            'berat' => $rusakBerat
        ]);
    }
}
