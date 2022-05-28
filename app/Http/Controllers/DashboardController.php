<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Inventaris;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $idUmumHabis=[];
    protected $idUmumMenipis=[];
    protected $akun;

    public function index()
    {
        $this->akun = User::where('id_super',Auth::id())->get();
        $barangUmum = Barang::where('id_user', Auth::id()) //mengambil data dari id user untuk akun user
            ->where('kategori',false)
            ->orWhereIn('id_user',$this->akun->modelKeys())->get(); // mengambil data dari dari id user turunan SU untuk SU

        $rusakRingan = Inventaris::where('kondisi',2)->count();
        $rusakBerat =  Inventaris::where('kondisi',3)->count();
            foreach ($barangUmum as $b) {
            $jumlah = $b->masuk->sum('jumlah') - $b->keluar->sum('jumlah');
            if ($jumlah==0) {
                $this->idUmumHabis[]=$b->id;
            }
            elseif($jumlah<11)
            {
                $this->idUmumMenipis[]=$b->id;
            }
        }

        return view('admin.dashboard',[
            'menipis' => $this->idUmumMenipis,
            'habis' => $this->idUmumHabis
        ]);
    }

    public function umumHabis()
    {

    }

    public function umumMenipis()
    {

    }

    public function rusakBerat()
    {

    }

    public function rusakRingan()
    {
        # code...
    }
}
