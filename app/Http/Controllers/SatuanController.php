<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satua = Satuan::where('id_user',Auth::id())->get();

        return view('admin.satuan.index',[
            'satuans' => $satua
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'nama' => 'required'
        ]);

        $satuan = new Satuan();
        $satuan->nama = $request->input('nama');
        $satuan->id_user = Auth::id();

        $satuan->save();

        return redirect()->route('satuan.index')->with('success', 'Data Berhasil Tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function show(Satuan $satuan)
    {
        return view('admin.satuan.show',[
            'satuan' => $satuan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Satuan $satuan)
    {
        // dd($satuan);
        return view('admin.satuan.edit',[
            'satuan' => $satuan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Satuan $satuan)
    {
        // dd($satuan);
        $this->validate($request,[
            'nama' => 'required'
        ]);

        $satuan->nama = $request->input('nama');

        $satuan->save();

        return redirect()->route('satuan.index')->with('success', 'Data Terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Satuan $satuan)
    {
        // dd($satuan);
        $satuan->delete();

        return redirect()->route('satuan.index')->with('warning','Data Terhapus');
    }
}
