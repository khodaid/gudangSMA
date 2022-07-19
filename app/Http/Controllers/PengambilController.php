<?php

namespace App\Http\Controllers;

use App\Models\Pengambil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengambilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id_super', Auth::id())->get();
        $pengambil = Pengambil::where('id_user', Auth::id())
            ->orWhere('id_user', Auth::user()->id_super)
            ->orWhereIn('id_user', $users->modelKeys())->get();

        return view('admin.pengambil.index', [
            'pengambil' => $pengambil
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
            'jabatan' => 'required'
        ]);

        // dd($request);

        $pengambil = new Pengambil();
        $pengambil->nama = $request->input('nama');
        $pengambil->jabatan = $request->input('jabatan');
        $pengambil->id_user = Auth::id();

        $pengambil->save();

        return redirect()->route('pengambil.index')->with(['store' => 'Data Tesimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengambil  $pengambil
     * @return \Illuminate\Http\Response
     */
    public function show(Pengambil $pengambil)
    {
        return view('admin.pengambil.show', [
            'pengambil' => $pengambil
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengambil  $pengambil
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengambil $pengambil)
    {
        return view('admin.pengambil.edit', [
            'pengambil' => $pengambil
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengambil  $pengambil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengambil $pengambil)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jabatan' => 'required'
        ]);

        $pengambil->nama = $request->input('nama');
        $pengambil->jabatan = $request->input('jabatan');
        $pengambil->id_user = Auth::id();

        $pengambil->save();

        return redirect()->route('pengambil.index')->with(['update' => 'Data Terupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengambil  $pengambil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengambil $pengambil)
    {
        $pengambil->delete();

        return redirect()->route('pengambil.index')->with(['hapus' => 'Data Terhapus']);
    }
}
