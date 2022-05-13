<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventaris;
use App\Models\User;
use App\Models\Barang;
use App\Models\Dana;
use App\Models\Satuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id_super',Auth::id())->get();

        $satuans = Satuan::where('id_user',Auth::user()->id_super)->get();

        $inventaris = Inventaris::where('id_user',Auth::id())
            ->orWhere('id_user',$users->modelKeys())->get();

        $barangs = Barang::where('id_user', Auth::id())->get();

        $danas = Dana::where('id_user',Auth::id())
            ->orWhere('id_user',Auth::user()->id_super)
            ->orWhereIn('id_user',$users->modelKeys())->get();

        dd(time());
        return view('admin.inventaris.index',[
            'satuans' => $satuans,
            'inventaris' => $inventaris,
            'barangs' => $barangs,
            'danas' => $danas
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
            'pembukuan' => 'required',
            'kode' => 'required',
            'id_barang' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required',
            'id_satuan' => 'required',
            'pembuatan' => 'required',
            'id_dana' => 'required',
            'penyerahan' => 'required',
            'kondisi' => 'required',
            'harga' => 'required',
            'hrg_total' => 'required',
            'file' => 'required|file|pdf'
        ]);

        $file_name = $request->input('kode').'_'.$request->file('file')->getClientOriginalName();

        $inventaris = new Inventaris();

        $inventaris->tgl_pembukuan = $request->input('pembukuan');
        $inventaris->kode = $request->input('kode');
        $inventaris->nama = $request->input('nama');
        $inventaris->id_barang = $request->input('id_barang');
        $inventaris->deskripsi = $request->input('deskripsi');
        $inventaris->jumlah = $request->input('jumlah');
        $inventaris->id_satuan = $request->input('id_satuan');
        $inventaris->thn_pembuatan = $request->input('pembuatan');
        $inventaris->id_dana = $request->input('id_dana');
        $inventaris->thn_penyerahan = $request->input('penyerahan');
        $inventaris->kondisi = $request->input('kondisi');
        $inventaris->harga = $request->input('harga');
        $inventaris->hrg_total = $request->input('hrg_total');
        $inventaris->file = $file_name;
        $inventaris->id_user = Auth::id();

        $inventaris->save();

        Storage::put('public/files', $file_name);
        return redirect()->route('masuk.index')->with(['store' => 'Data Tersimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function show(Inventaris $inventaris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventaris $inventaris)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventaris $inventaris)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventaris $inventaris)
    {
        //
    }
}
