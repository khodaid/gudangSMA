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
    protected $idUmumHabis=[];
    protected $idUmumMenipis=[];
    // protected $akun;

    public function index()
    {
        $akun = User::where('id_super',Auth::id())->get();
        // $barangUmum = Barang::where('id_user', Auth::id()) //mengambil data dari id user untuk akun user
        //     ->where('kategori',false)
        //     ->orWhereIn('id_user',$akun->modelKeys())
        //     ->with(['masuk','keluar','satuan'])
        //     ->get(); // mengambil data dari dari id user turunan SU untuk SU

        $rusakRingan = Inventaris::where('kondisi',2)
                        ->with('barang','satuan','dana')
                        ->get();
        $rusakBerat =  Inventaris::where('kondisi',3)
                        ->with('barang','satuan','dana')
                        ->get();

        // foreach ($barangUmum as $b) {
        //     $jumlah = $b->masuk->sum('jumlah') - $b->keluar->sum('jumlah');
        //     if ($jumlah==0) {
        //         $this->idUmumHabis[$b->id]=['id' => $b->id, 'jumlah' => $jumlah];
        //     }
        //     elseif($jumlah<11)
        //     {
        //         $this->idUmumMenipis[$b->id]=['id' => $b->id, 'jumlah' => $jumlah];
        //     }
        // }

        $barangMenipis = Barang::leftJoin('masuks','masuks.id_barang','=','barangs.id')
                        ->leftJoin('keluars','keluars.id_barang','=','barangs.id')
                        ->select('barangs.id','barangs.nama','barangs.id_satuan',DB::raw('ifnull(sum(masuks.jumlah),0) - ifnull(sum(keluars.jumlah),0) as jumlah'))
                        ->where('barangs.id_user',Auth::id())
                        ->where('barangs.kategori',false)
                        ->orWhereIn('barangs.id_user',$akun->modelKeys())
                        ->groupBy('barangs.id','barangs.nama','barangs.id_satuan')
                        ->havingBetween('jumlah',[1,10])
                        ->with('satuan')
                        ->get();

        $barangHabis = Barang::leftJoin('masuks','masuks.id_barang','=','barangs.id')
                    ->leftJoin('keluars','keluars.id_barang','=','barangs.id')
                    ->select('barangs.id','barangs.nama','barangs.id_satuan',DB::raw('ifnull(sum(masuks.jumlah),0) - ifnull(sum(keluars.jumlah),0) as jumlah'))
                    ->where('barangs.id_user',Auth::id())
                    ->where('barangs.kategori',false)
                    ->orWhereIn('barangs.id_user',$akun->modelKeys())
                    ->groupBy('barangs.id','barangs.nama','barangs.id_satuan')
                    ->having('jumlah','=',0)
                    ->with('satuan')
                    ->get();

        // dd($barangHabis);

        // $tipis = Barang::whereIn('id',Arr::pluck($this->idUmumMenipis,'id'))
        //         ->with('satuan')
        //         ->paginate(100);
        // $habis = Barang::whereIn('id',Arr::pluck($this->idUmumHabis,'id'))
        //         ->with('satuan')
        //         ->paginate(100);

        return view('admin.dashboard',[
            // 'jumlahMenipis' => $this->idUmumMenipis,
            // 'jumlahHabis' => $this->idUmumHabis,
            'habis' => $barangHabis,
            'menipis' => $barangMenipis,
            'ringan' => $rusakRingan,
            'berat' => $rusakBerat
        ]);
    }
}
