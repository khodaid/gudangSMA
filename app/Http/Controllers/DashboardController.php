<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Inventaris;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

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

        $rusakRingan = Inventaris::where('kondisi',2)->get();
        $rusakBerat =  Inventaris::where('kondisi',3)->get();
        foreach ($barangUmum as $b) {
            $jumlah = $b->masuk->sum('jumlah') - $b->keluar->sum('jumlah');
            if ($jumlah==0) {
                $this->idUmumHabis[$b->id]=['id' => $b->id, 'jumlah' => $jumlah];
            }
            elseif($jumlah<11)
            {
                $this->idUmumMenipis[$b->id]=['id' => $b->id, 'jumlah' => $jumlah];
            }
        }
        $tipis = Barang::whereIn('id',Arr::pluck($this->idUmumMenipis,'id'))->get();
        $habis = Barang::whereIn('id',Arr::pluck($this->idUmumHabis,'id'))->get();
        // dd([$this->idUmumHabis,$this->idUmumMenipis,$habis,$tipis]);

        return view('admin.dashboard',[
            'jumlahMenipis' => $this->idUmumMenipis,
            'jumlahHabis' => $this->idUmumHabis,
            'menipis' => $tipis,
            'habis' => $habis,
            'ringan' => $rusakRingan,
            'berat' => $rusakBerat
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
