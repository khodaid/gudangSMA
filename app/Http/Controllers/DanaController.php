<?php

namespace App\Http\Controllers;

use App\Models\Dana;
use Illuminate\Http\Request;

class DanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dana = Dana::all();

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
            'nama' => 'required'
        ]);

        return redirect()->route('dana.index')->with('success','Data Tesimpan');
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
            'nama' => 'required'
        ]);

        $dana->nama = $request->input('nama');

        return redirect()->route('dana.index')->with('success','Data Terupdate');
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

        return redirect()->route('dana.index')->with('warning','Data Terhapus');
    }
}
