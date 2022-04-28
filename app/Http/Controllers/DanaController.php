<?php

namespace App\Http\Controllers;

use App\Models\Dana;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $akun = User::where('id_super',Auth::id())->get();

        $dana = Dana::where('id_user',Auth::id())
            ->orWhere('id_user',Auth::user()->id_super)
            ->orWhereIn('id_user',$akun->modelKeys())->get();

        return view('admin.dana.index',[
            'danas' => $dana
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

        $dana = new Dana();
        $dana->nama = $request->input('nama');
        $dana->keterangan = $request->input('deskripsi');
        $dana->id_user = Auth::id();

        $dana->save();

        return redirect()->route('dana.index')->with(['store' => 'Data Tesimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dana  $dana
     * @return \Illuminate\Http\Response
     */
    public function show(Dana $dana)
    {
        return view('admin.dana.show',[
            'dana' => $dana
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dana  $dana
     * @return \Illuminate\Http\Response
     */
    public function edit(Dana $dana)
    {
        return view('admin.dana.edit',[
            'dana' => $dana
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dana  $dana
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dana $dana)
    {
        $this->validate($request,[
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);

        $dana->nama = $request->input('nama');
        $dana->keterangan = $request->input('deskripsi');

        $dana->save();

        return redirect()->route('dana.index')->with(['update' => 'Data Terupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dana  $dana
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dana $dana)
    {
        $dana->delete();

        return redirect()->route('dana.index')->with(['hapus' => 'Data Terhapus']);
    }
}
