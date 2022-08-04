<?php

namespace App\Http\Controllers;

use App\Exports\MasukExport;
use App\Models\Barang;
use App\Models\Masuk;
use App\Models\Satuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class MasukController extends Controller
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

        $masuks = Masuk::where('id_user',Auth::id())
            ->orWhere('id_user',$users->modelKeys())
            ->with(['barang','satuan','user'])
            ->paginate(100);
            // ->get();

        $barangs = Barang::where('id_user', Auth::id())
            ->where('id_kategori','!=',1)->get();

        return view('admin.masuk.index',[
            'satuans' => $satuans,
            'masuks' => $masuks,
            'barangs' => $barangs
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
        // dd($request);
        $request->validate([
            'barang' => 'required',
            'deskripsi' => 'required',
            'quantity' => 'required',
            'satuan' => 'required',
            'pembelian' => 'required',
            'penyerahan' => 'required',
            'hrgSatuan' => 'required',
            'hrgTotal' => 'required',
            'file' => 'required|mimes:pdf'
        ]);

        // dd($request);
        $file = $request->file('file');
        $file_name = time()."_".$file->getClientOriginalName();

        $masuk = new Masuk();

        $masuk->id_barang = $request->input('barang');
        $masuk->deskripsi = $request->input('deskripsi');
        $masuk->jumlah = $request->input('quantity');
        $masuk->id_satuan = $request->input('satuan');
        $masuk->nama_toko = $request->input('toko');
        $masuk->tgl_pemesanan = $request->input('pembelian');
        $masuk->tgl_penerimaan = $request->input('penyerahan');
        $masuk->harga_satuan = $request->input('hrgSatuan');
        $masuk->jumlah_harga = $request->input('hrgTotal');
        $masuk->id_user = Auth::id();
        $masuk->file = $file_name;

        $masuk->save();
        $path = $file->storeAs('public/files/nota',$file_name);

        return redirect()->route('masuk.index')->with(['store' => 'Data Tersimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Masuk  $masuk
     * @return \Illuminate\Http\Response
     */
    public function show(Masuk $masuk)
    {
        return view('admin.masuk.show',[
            'masuk' => $masuk
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Masuk  $masuk
     * @return \Illuminate\Http\Response
     */
    public function edit(Masuk $masuk)
    {
        $barangs = Barang::where('id_user', Auth::id())->get();
        $satuans = Satuan::where('id_user',Auth::user()->id_super)->get();

        return view('admin.masuk.edit',[
            'masuk' => $masuk,
            'barangs' => $barangs,
            'satuans' => $satuans
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Masuk  $masuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Masuk $masuk)
    {
        $this->validate($request,[
            'barang' => 'required',
            'deskripsi' => 'required',
            'quantity' => 'required',
            'satuan' => 'required',
            'pembelian' => 'required',
            'penyerahan' => 'required',
            'hrgSatuan' => 'required',
            'hrgTotal' => 'required'
        ]);

        $file = $masuk->file;
        $file_name = $masuk->file;
        if ($request->hasFile('file')) {
            if (Storage::exists('public/files/nota/'.$file)) {
                Storage::delete('public/files/nota/'.$file);
            }
            $file = $request->file('file');
            $file_name = time()."_".$file->getClientOriginalName();
            $path = $file->storeAs('public/files', $file_name);
        }


        $masuk->id_barang = $request->input('barang');
        $masuk->deskripsi = $request->input('deskripsi');
        $masuk->jumlah = $request->input('quantity');
        $masuk->id_satuan = $request->input('satuan');
        $masuk->nama_toko = $request->input('toko');
        $masuk->tgl_pemesanan = $request->input('pembelian');
        $masuk->tgl_penerimaan = $request->input('penyerahan');
        $masuk->harga_satuan = $request->input('hrgSatuan');
        $masuk->jumlah_harga = $request->input('hrgTotal');
        $masuk->file = $file_name;
        $masuk->save();
        return redirect()->route('masuk.index')->with(['update' => 'Data Terupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Masuk  $masuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Masuk $masuk)
    {
        $masuk->delete();

        return redirect()->route('masuk.index')->with(['hapus' => 'Data Terhapus']);
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
        return Excel::download(new MasukExport($this->dari, $this->sampai), 'masuk.xlsx');
    }

    public function viewPdf(Masuk $masuk)
    {
        return view('admin.masuk.pdf',[
            'masuk' => $masuk
        ]);
    }
}
