<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Models\Barang;
use App\Models\Masuk;
use App\Models\Satuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

class BarangController extends Controller
{
    protected $transaksi=[];
    protected $option;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $akun = User::where('id_super',Auth::id())->get();

        $satuan = Satuan::where('id_user',Auth::id())
            ->orWhere('id_user',Auth::user()->id_super)->get();

        // $barang = Barang::where('id_user', Auth::id()) //mengambil data dari id user untuk akun user
        //     ->orWhereIn('id_user',$akun->modelKeys())->get(); // mengambil data dari dari id user turunan SU untuk SU

            // $masuk = Masuk::where('id_user', Auth::id())
            // ->orWhereIn('id_user',$akun->modelKeys())->sum('jumlah')->get();

            // $coba = DB::table('barangs as b')
            //     ->leftjoin('keluars as k','b.id','=','k.id_barang')
            //     ->leftjoin('masuks as m','b.id','=','m.id_barang')
            //     ->select('b.nama','b.id_satuan',DB::raw('ifnull(sum(m.jumlah),0) - ifnull(sum(k.jumlah),0) as jumlah'))
            //     ->groupBy('b.nama','b.id_satuan')
            //     ->with('satuan')
            //     ->get();
            $barang = Barang::leftJoin('keluars','barangs.id','=','keluars.id_barang')
                    ->leftJoin('masuks','barangs.id','=','masuks.id_barang')
                    ->select('barangs.nama','barangs.id','barangs.id_satuan','barangs.kategori',DB::raw('ifnull(sum(masuks.jumlah),0) - ifnull(sum(keluars.jumlah),0) as jumlah'))
                    ->groupBy('barangs.nama','barangs.id','barangs.id_satuan','barangs.kategori')
                    ->where('barangs.id_user', Auth::id())
                    ->orWhereIn('barangs.id_user',$akun->modelKeys())
                    ->get();
            // dd($coba);
            // dd($barang);

        // $transaksi=[];
        // dd($this->transaksi);
        // $jumlah =[];
        // foreach ($barang as $b) {
        //     // $masuk = Masuk::where('id_barang', $b->id)->sum('jumlah');
        //     // $transaksi[] = $b->masuk->sum('jumlah') - $b->keluar->sum('jumlah');
        //     // $transaksi = Collection::make($b->masuk->sum('jumlah') - $b->keluar->sum('jumlah'));
        //     $this->transaksi[$b->id] = $b->masuk->sum('jumlah') - $b->keluar->sum('jumlah');
        //     // $jumlah[$b->id] =  $b->masuk->sum('jumlah') - $b->keluar->sum('jumlah');
        // }
        // dd($i);
        // $transaksi = collect((object)$transaksi);
        // dd($transaksi);
        // $tr = [
        //     'b' => $barang,
        //     't' => $transaksi];
        // dd($this->transaksi);
        return view('admin.barang.index',[
            'barangs' => $barang,
            'satuans' => $satuan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required',
            'satuan' => 'required'
        ]);

        $barang = new Barang();

        $barang->nama = $request->input('nama');
        $barang->id_satuan = $request->input('satuan');
        $barang->id_user = Auth::id();

        $barang->save();

        return redirect()->route('barang.index')->with(['store' => 'Data Tersimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        if ($barang->kategori) {
            $jumlah = $barang->inventaris->count();
        } else {
            $jumlah = $barang->masuk->sum('jumlah') - $barang->keluar->sum('jumlah');
        }

        return view('admin.barang.show',[
            'barang' => $barang,
            'jumlah' => $jumlah
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        $satuans = Satuan::where('id_user',Auth::id())
        ->orWhere('id_user',Auth::user()->id_super)->get();

        return view('admin.barang.edit',[
            'barang' => $barang,
            'satuans' => $satuans
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $this->validate($request,[
            'nama' => 'required',
            'satuan' => 'required'
        ]);

        $barang->nama = $request->input('nama');
        $barang->id_satuan = $request->input('satuan');

        $barang->save();

        return redirect()->route('barang.index')->with(['update' => 'Data Terupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with(['hapus' => 'Data Terhapus']);
    }

    public function export(Request $request)
    {
        $this->option = $request->kategori;
        $export = $this->export_excel();
        return $export;
    }

    public function export_excel()
    {
        return Excel::download(new BarangExport($this->option), 'barang.xlsx');
    }
}
