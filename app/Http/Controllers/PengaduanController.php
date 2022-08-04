<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengaduan = Pengaduan::orderBy('id','desc')->get();
        return view('admin.pengaduan.index',[
            'pengaduans' => $pengaduan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nomer = 0;
        $pengaduan = Pengaduan::all()->last();
        $date = Carbon::now()->timezone('Asia/Jakarta');

        if (!isset($pengaduan)) {
            $nomer = 1;
        }else {
            $nomer = $pengaduan->id + 1;
        }

        $noPengaduan = "RS/".$nomer."/".$date->format('d')."/".$date->format('m')."/".$date->format('Y');
        // dd($noPengaduan);
        return view('pengaduan-create',[
            'nomer' => $noPengaduan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomer' => 'required',
            'nama' => 'required',
            'departement' => 'required',
            'barang' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required',
            'lokasi' => 'required'
        ]);

        // dd($request->nomer);
        $file = $request->file('foto');
        $file_name = time().$file->getClientOriginalName();

        $pengaduan = new Pengaduan();
        $pengaduan->nomer_pengaduan = $request->nomer;
        $pengaduan->name = $request->nama;
        $pengaduan->departement = $request->departement;
        $pengaduan->barang = $request->barang;
        $pengaduan->description = $request->deskripsi;
        $pengaduan->photo = $file_name;
        $pengaduan->location = $request->lokasi;
        $pengaduan->date = Carbon::now()->timezone('Asia/Jakarta');

        $pengaduan->save();
        $file->storeAs('public/files/pengaduan',$file_name);

        return redirect()->back()->with('success','pengaduan berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show',[
            'pengaduan' => $pengaduan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        $this->validate($request,[
            'kondisi' => 'required'
        ]);

        $pengaduan->status = $request->kondisi;
        $pengaduan->save();

        return redirect()->back()->with(['update' => 'Data Berhasil Terupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengaduan $pengaduan)
    {
        if (Storage::exists('public/files/pengaduan/'.$pengaduan->photo)) {
            Storage::delete('public/files/pengaduan/'.$pengaduan->photo);
        }
        $pengaduan->delete();

        return redirect()->back()->with('hapus','Data Berhasil Dihapus');
    }
}
