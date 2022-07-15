<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id_super',Auth::id())->get();
        $kategori = Kategori::where('id_user',Auth::id())
            ->orWhere('id_user',Auth::user()->id_super)
            ->orWhereIn('id_user',$users->modelKeys())->get();
        return view('admin.kategori.index',[
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
        $this->validate($request,[
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);

        $kategori = new Kategori();
        $kategori->nama_lokasi = $request->input('nama');
        $kategori->deskripsi = $request->input('deskripsi');
        $kategori->id_user = Auth::id();

        $kategori->save();

        return redirect()->route('kategori.index')->with(['store' => 'Data Tesimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        return view('admin.kategori.show',[
            'kategori' => $kategori
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit',[
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $this->validate($request,[
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);

        $kategori->nama = $request->input('nama');
        $kategori->keterangan = $request->input('deskripsi');

        $kategori->save();

        return redirect()->route('kategori.index')->with(['update' => 'Data Terupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')->with(['hapus' => 'Data Terhapus']);
    }
}
