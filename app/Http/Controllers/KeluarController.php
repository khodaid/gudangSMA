<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keluar;
use App\Models\Satuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KeluarExport;
use App\Models\Pengambil;
use Illuminate\Support\Facades\DB;

class KeluarController extends Controller
{
    protected $dari, $sampai;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $barang = Barang::where('id_user', Auth::id())
        //     ->where('id_kategori', '!=', 1)->get();
        $akun = User::where('id_super', Auth::id())->get();
        $satuan = Satuan::where('id_user', Auth::user()->id_super)->get();
        $barang = Barang::where('barangs.id_kategori', '>', 1)
            ->where(function ($query) use ($akun) {
                $query->where('barangs.id_user', Auth::id())
                    ->orWhereIn('barangs.id_user', $akun->modelKeys());
            })
            ->leftJoin('masuks', 'masuks.id_barang', '=', 'barangs.id')
            ->leftJoin('keluars', 'keluars.id_barang', '=', 'barangs.id')
            ->select('barangs.id', 'barangs.nama', 'barangs.id_satuan', DB::raw('ifnull(sum(masuks.jumlah),0) - ifnull(sum(keluars.jumlah),0) as jumlah'))
            ->groupBy('barangs.id', 'barangs.nama', 'barangs.id_satuan')
            ->having('jumlah', '>', 0)
            ->with('satuan')
            ->get();
        $user = User::where('id_super', Auth::id())->get();
        $keluar = Keluar::where('id_user', Auth::id())
            ->orWhere('id_user', $user->modelKeys())
            ->with(['barang', 'satuan'])
            ->paginate(100);
        $pengambil = Pengambil::where('id_user', Auth::id())->get();
        return view('admin.keluar.index', [
            'satuans' => $satuan,
            'barangs' => $barang,
            'keluars' => $keluar,
            'pengambils' => $pengambil
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
            'barang' => 'required',
            'quantity' => 'required',
            'satuan' => 'required',
            'tglPengambilan' => 'required',
            'deskripsi' => 'required',
            'pengambil' => 'required'
        ]);

        $keluar = new Keluar();

        $keluar->tgl_keluar = $request->input('tglPengambilan');
        $keluar->deskripsi = $request->input('deskripsi');
        $keluar->jumlah = $request->input('quantity');
        $keluar->id_barang = $request->input('barang');
        $keluar->id_user = Auth::id();
        $keluar->id_satuan = $request->input('satuan');
        $keluar->id_pengambil = $request->input('pengambil');

        $keluar->save();

        return redirect()->route('keluar.index')->with(['store' => 'Data Berhasil Ditambah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keluar  $keluar
     * @return \Illuminate\Http\Response
     */
    public function show(Keluar $keluar)
    {
        return view('admin.keluar.show', [
            'keluar' => $keluar
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keluar  $keluar
     * @return \Illuminate\Http\Response
     */
    public function edit(Keluar $keluar)
    {
        // $barangs = Barang::where('id_user', Auth::id())
        //     ->where('id_kategori', '!=', 1)->get();
        $akun = User::where('id_super', Auth::id())->get();
        $barangs = Barang::where('barangs.id_kategori', '>', 1)
            ->where(function ($query) use ($akun) {
                $query->where('barangs.id_user', Auth::id())
                    ->orWhereIn('barangs.id_user', $akun->modelKeys());
            })
            ->leftJoin('masuks', 'masuks.id_barang', '=', 'barangs.id')
            ->leftJoin('keluars', 'keluars.id_barang', '=', 'barangs.id')
            ->select('barangs.id', 'barangs.nama', 'barangs.id_satuan', DB::raw('ifnull(sum(masuks.jumlah),0) - ifnull(sum(keluars.jumlah),0) as jumlah'))
            ->groupBy('barangs.id', 'barangs.nama', 'barangs.id_satuan')
            ->having('jumlah', '>', 0)
            ->with('satuan')
            ->get();
        $satuans = Satuan::where('id_user', Auth::user()->id_super)->get();
        $pengambil = Pengambil::where('id_user', Auth::id())->get();

        return view('admin.keluar.edit', [
            'keluar' => $keluar,
            'barangs' => $barangs,
            'satuans' => $satuans,
            'pengambils' => $pengambil
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keluar  $keluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keluar $keluar)
    {
        $this->validate($request, [
            'barang' => 'required',
            'quantity' => 'required',
            'satuan' => 'required',
            'tglPengambilan' => 'required',
            'deskripsi' => 'required',
            'pengambil' => 'required'
        ]);

        $keluar->tgl_keluar = $request->input('tglPengambilan');
        $keluar->deskripsi = $request->input('deskripsi');
        $keluar->jumlah = $request->input('quantity');
        $keluar->id_barang = $request->input('barang');
        $keluar->id_user = Auth::id();
        $keluar->id_satuan = $request->input('satuan');
        $keluar->id_pengambil = $request->input('pengambil');

        $keluar->save();

        return redirect()->route('keluar.index')->with(['update' => 'Data Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keluar  $keluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keluar $keluar)
    {
        $keluar->delete();
        return redirect()->route('keluar.index')->with(['hapus' => 'Data Berhasil Dihapus']);
    }

    public function export(Request $request)
    {
        $this->dari = $request->dari;
        $this->sampai = $request->sampai;
        $export = $this->export_excel();

        return $export;
    }

    public function export_excel()
    {
        return Excel::download(new KeluarExport($this->dari, $this->sampai), 'keluar.xlsx');
    }
}
