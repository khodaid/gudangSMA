<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Models\Barang;
use App\Models\Kategori;
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
    protected $transaksi = [];
    protected $option;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->roles == 3) {
            $akun = User::where('id_super', Auth::user()->id_super)->get();
        }else {
        $akun = User::where('id_super', Auth::id())->get();
        }

        $satuan = Satuan::where('id_user', Auth::id())
            ->orWhere('id_user', Auth::user()->id_super)->get();
        $kategori = Kategori::where('id_user', Auth::id())
            ->orWhere('id_user', Auth::user()->id_super)->get();

        $barang = Barang::leftJoin('keluars', 'barangs.id', '=', 'keluars.id_barang')
            ->leftJoin('masuks', 'barangs.id', '=', 'masuks.id_barang')
            ->select('barangs.nama', 'barangs.id', 'barangs.id_satuan', 'barangs.id_kategori', 'barangs.kode_barang', DB::raw('ifnull(sum(masuks.jumlah),0) - ifnull(sum(keluars.jumlah),0) as jumlah'))
            ->groupBy('barangs.nama', 'barangs.id', 'barangs.id_satuan', 'barangs.id_kategori', 'barangs.kode_barang')
            ->where('barangs.id_user', Auth::id())
            ->orWhereIn('barangs.id_user', $akun->modelKeys())
            ->with(['satuan', 'user', 'inventaris','kategori'])
            ->get();

        return view('admin.barang.index', [
            'barangs' => $barang,
            'satuans' => $satuan,
            'kategoris' => $kategori
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
        $this->validate($request, [
            'nama' => 'required',
            'satuan' => 'required',
            'kode' => 'required',
            'kategori' => 'required'
        ]);

        $barang = new Barang();

        $barang->nama = $request->input('nama');
        $barang->kode_barang = $request->input('kode');
        $barang->id_kategori = $request->input('kategori');
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
        if ($barang->id_kategori == 1) {
            $jumlah = $barang->inventaris->count();
        } else {
            $jumlah = $barang->masuk->sum('jumlah') - $barang->keluar->sum('jumlah');
        }

        return view('admin.barang.show', [
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
        $satuans = Satuan::where('id_user', Auth::id())
            ->orWhere('id_user', Auth::user()->id_super)->get();

        return view('admin.barang.edit', [
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
        $this->validate($request, [
            'nama' => 'required',
            'satuan' => 'required',
            'kode' => 'required',
            'kategori' => 'required'
        ]);

        $barang->nama = $request->input('nama');
        $barang->id_satuan = $request->input('satuan');
        $barang->kode_barang = $request->input('kode');
        $barang->id_kategori = $request->input('kategori');
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
