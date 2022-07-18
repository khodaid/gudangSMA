<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id_super',Auth::id())->get();
        $lokasi = Lokasi::where('id_user',Auth::id())
            ->orWhere('id_user',Auth::user()->id_super)
            ->orWhereIn('id_user',$users->modelKeys())->get();
        return view('admin.lokasi.index',[
            'lokasis' => $lokasi
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
            'deskripsi' => 'required'
        ]);

        $lokasi = new Lokasi();
        $lokasi->nama_lokasi = $request->input('nama');
        $lokasi->deskripsi = $request->input('deskripsi');
        $lokasi->id_user = Auth::id();

        $lokasi->save();

        return redirect()->route('lokasi.index')->with(['store' => 'Data Tesimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show(Lokasi $lokasi)
    {
        return view('admin.lokasi.show',[
            'lokasi' => $lokasi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Lokasi $lokasi)
    {
        return view('admin.lokasi.edit',[
            'lokasi' => $lokasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        $this->validate($request,[
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);

        $lokasi->nama_lokasi = $request->input('nama');
        $lokasi->deskripsi = $request->input('deskripsi');

        $lokasi->save();

        return redirect()->route('lokasi.index')->with(['update' => 'Data Terupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();

        return redirect()->route('lokasi.index')->with(['hapus' => 'Data Terhapus']);
    }
}
