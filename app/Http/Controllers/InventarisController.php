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
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventarisExport;

class InventarisController extends Controller
{
    protected $dari, $sampai;
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

        // dd(time());
        return view('admin.inventaris.index',[
            'satuans' => $satuans,
            'inventariss' => $inventaris,
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
        // dd($request->all());
        $request->validate([
            'pembukuan' => 'required',
            'kode' => 'required',
            'id_barang' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required',
            'id_satuan' => 'required',
            'pembuatan' => 'required',
            'id_dana' => 'required',
            'penyerahan' => 'required',
            'harga' => 'required',
            'hrg_total' => 'required',
            'file' => 'required|mimes:pdf'
        ]);

        $file = $request->file;
        $file_name = $request->kode.'_'.$file->getClientOriginalName();



        $inventaris = new Inventaris();

        $inventaris->tgl_pembukuan = $request->input('pembukuan');
        $inventaris->kode = $request->input('kode');
        $inventaris->id_barang = $request->input('id_barang');
        $inventaris->deskripsi = $request->input('deskripsi');
        $inventaris->jumlah = $request->input('jumlah');
        $inventaris->id_satuan = $request->input('id_satuan');
        $inventaris->thn_pembuatan = $request->input('pembuatan');
        $inventaris->id_dana = $request->input('id_dana');
        $inventaris->tgl_penyerahan = $request->input('penyerahan');
        $inventaris->kondisi = 1;
        $inventaris->harga = $request->input('harga');
        $inventaris->hrg_total = $request->input('hrg_total');
        $inventaris->file = $file_name;
        $inventaris->id_user = Auth::id();

        // dd($request->all());

        $inventaris->save();

        $barang = Barang::find($request->input('id_barang'));
        $barang->kategori = true;

        $barang->save();

        $path = $file->storeAs('public/files', $file_name);
        return redirect()->route('inventaris.index')->with(['store' => 'Data Tersimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function show(Inventaris $inventaris)
    {

        return view('admin.inventaris.show',[
            'inventaris' => $inventaris,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventaris $inventaris)
    {
        $users = User::where('id_super',Auth::id())->get();
        $satuans = Satuan::where('id_user',Auth::user()->id_super)->get();
        $barangs = Barang::where('id_user', Auth::id())->get();
        $danas = Dana::where('id_user',Auth::id())
            ->orWhere('id_user',Auth::user()->id_super)
            ->orWhereIn('id_user',$users->modelKeys())->get();
        return view('admin.inventaris.edit',[
            'inventaris' => $inventaris,
            'barangs' => $barangs,
            'satuans' => $satuans,
            'danas' => $danas
        ]);
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
        $request->validate([
            'pembukuan' => 'required',
            'kode' => 'required',
            'id_barang' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required',
            'id_satuan' => 'required',
            'pembuatan' => 'required',
            'id_dana' => 'required',
            'penyerahan' => 'required',
            'harga' => 'required',
            'hrg_total' => 'required',
        ]);

        $file = $inventaris->file;

        if ($request->hasFile('file')) {
            if (Storage::exists($inventaris->file)) {
                Storage::delete($inventaris->file);
            }
            $file = $request->file;
        }
        $file_name = $request->kode.'_'.$file->getClientOriginalName();

        if($request->id_barang != $inventaris->id_barang)
        {
            $barang = Barang::find($request->input('id_barang'));
            $barang->kategori = true;
            $brg = Barang::find($inventaris->id_barang);
            $brg->kategori = false;

            $barang->save();
            $brg->save();
        }

        $inventaris->tgl_pembukuan = $request->input('pembukuan');
        $inventaris->kode = $request->input('kode');
        $inventaris->id_barang = $request->input('id_barang');
        $inventaris->deskripsi = $request->input('deskripsi');
        $inventaris->jumlah = $request->input('jumlah');
        $inventaris->id_satuan = $request->input('id_satuan');
        $inventaris->thn_pembuatan = $request->input('pembuatan');
        $inventaris->id_dana = $request->input('id_dana');
        $inventaris->tgl_penyerahan = $request->input('penyerahan');
        $inventaris->harga = $request->input('harga');
        $inventaris->hrg_total = $request->input('hrg_total');
        $inventaris->file = $file_name;
        $inventaris->id_user = Auth::id();

        $inventaris->save();

        $path = $file->storeAs('public/files', $file_name);

        return redirect()->route('invetaris.index')->with(['update'=>'Data Berhasil Diubah']);
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

    public function rusak(Request $request, Inventaris $inventaris)
    {
        $request->validate([
            'pembukuan' => 'required',
            'jumlah' => 'required',
            'kondisi'=> 'required'
        ]);
        $rusak = new Inventaris();
        $rusak->tgl_pembukuan = $request->pembukuan;
        $rusak->kode = $inventaris->kode;
        $rusak->id_barang = $inventaris->id_barang;
        $rusak->deskripsi = $inventaris->deskripsi;
        $rusak->jumlah = $request->jumlah;
        $rusak->id_satuan = $inventaris->id_satuan;
        $rusak->thn_pembuatan = $inventaris->thn_pembuatan;
        $rusak->id_dana = $inventaris->id_dana;
        $rusak->tgl_penyerahan = $inventaris->tgl_penyerahan;
        $rusak->kondisi = $request->kondisi;
        $rusak->harga = $inventaris->harga;
        $rusak->hrg_total = $inventaris->hrg_total;
        $rusak->file = $inventaris->file;
        $rusak->id_user = $inventaris->id_user;
        $rusak->save();

        return redirect()->route('inventaris.index')->with(['update'=>'Data Berhasil Diubah']);
    }

    public function barang()
    {
        $baik = DB::table('inventaris')
                    ->select('kode','id_barang','jumlah','id_satuan','kondisi')
                    ->where('kondisi',1)->get();

        $rusak = DB::table('inventaris')
        ->select('kode','id_barang','jumlah','id_satuan','kondisi')
        ->where('kondisi',[2,3])->get();

        dd($baik, $rusak);
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
        return Excel::download(new InventarisExport($this->dari, $this->sampai), 'inventaris.xlsx');
    }
}
