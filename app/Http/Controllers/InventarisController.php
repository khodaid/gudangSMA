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
use App\Models\Lokasi;

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
        $users = User::where('id_super', Auth::id())->get();

        $satuans = Satuan::where('id_user', Auth::user()->id_super)->get();

        $inventaris = Inventaris::where('id_user', Auth::id())
            ->orWhere('id_user', $users->modelKeys())
            ->with(['satuan', 'barang', 'dana', 'user'])
            ->paginate(100);

        $barangs = Barang::where('id_user', Auth::id())
            ->where('id_kategori', 1)
            ->get();

        $danas = Dana::where('id_user', Auth::id())
            ->orWhere('id_user', Auth::user()->id_super)
            ->orWhereIn('id_user', $users->modelKeys())->get();

        $lokasi = Lokasi::Where('id_user', Auth::user()->id_super)->get();

        // dd($lokasi);
        return view('admin.inventaris.index', [
            'satuans' => $satuans,
            'inventariss' => $inventaris,
            'barangs' => $barangs,
            'danas' => $danas,
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
        // dd($request->all());
        $request->validate([
            'pembukuan' => 'required',
            'kode' => 'required',
            'id_barang' => 'required',
            'deskripsi' => 'required',
            'id_satuan' => 'required',
            'pembuatan' => 'required',
            'id_dana' => 'required',
            'penyerahan' => 'required',
            'harga' => 'required',
            'lokasi' => 'required',
            'file' => 'required|mimes:pdf'
        ]);

        $file = $request->file;
        $file_name = time() . '_' . $file->getClientOriginalName();

        if (count($request->kode) > 0) {

            foreach ($request->kode as $key => $value) {
                // $inventaris = new Inventaris();
                $file_name = $request->kode[$key] . '_' . $file->getClientOriginalName();
                $inventaris = array(
                    'tgl_pembukuan' => $request->input('pembukuan'),
                    'kode' => $request->input('kode')[$key],
                    'id_barang' => $request->input('id_barang'),
                    'deskripsi' => $request->input('deskripsi'),
                    'id_satuan' => $request->input('id_satuan'),
                    'thn_pembuatan' => $request->input('pembuatan'),
                    'id_dana' => $request->input('id_dana'),
                    'tgl_penyerahan' => $request->input('penyerahan'),
                    'kondisi' => 1,
                    'harga' => $request->input('harga'),
                    'id_lokasi' => $request->input('lokasi'),
                    'file' => $file_name,
                    'id_user' => Auth::id(),
                );
                Inventaris::create($inventaris);
<<<<<<< HEAD
                $path = $file->storeAs('public/files/nota', $file_name);
=======
                $path = $file->storeAs('public/files', $file_name);
>>>>>>> 58254bfc0e1bbd6e8adddb835398b9396d7feff5
            }
        } else {
            $inventaris = new Inventaris();

            $inventaris->tgl_pembukuan = $request->input('pembukuan');
            $inventaris->kode = $request->input('kode');
            $inventaris->id_barang = $request->input('id_barang');
            $inventaris->deskripsi = $request->input('deskripsi');
            $inventaris->id_satuan = $request->input('id_satuan');
            $inventaris->thn_pembuatan = $request->input('pembuatan');
            $inventaris->id_dana = $request->input('id_dana');
            $inventaris->tgl_penyerahan = $request->input('penyerahan');
            $inventaris->kondisi = 1;
            $inventaris->harga = $request->input('harga');
            $inventaris->id_lokasi =  $request->input('lokasi');
            $inventaris->file = $file_name;
            $inventaris->id_user = Auth::id();

            $inventaris->save();
        }

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
        // $inventaris = $inventaris->lokasi()->get();
        return view('admin.inventaris.show', [
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
        $users = User::where('id_super', Auth::id())->get();
        $satuans = Satuan::where('id_user', Auth::user()->id_super)->get();
        $barangs = Barang::where('id_user', Auth::id())
            ->where('id_kategori', 1)
            ->get();
        $danas = Dana::where('id_user', Auth::id())
            ->orWhere('id_user', Auth::user()->id_super)
            ->orWhereIn('id_user', $users->modelKeys())->get();
        $lokasi = Lokasi::Where('id_user', Auth::user()->id_super)->get();
        // dd($lokasi);
        return view('admin.inventaris.edit', [
            'inventaris' => $inventaris,
            'barangs' => $barangs,
            'satuans' => $satuans,
            'danas' => $danas,
            'lokasis' => $lokasi
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
        // dd($request);
        $request->validate([
            'pembukuan' => 'required',
            'kode' => 'required',
            'id_barang' => 'required',
            'deskripsi' => 'required',
            'id_satuan' => 'required',
            'pembuatan' => 'required',
            'id_dana' => 'required',
            'penyerahan' => 'required',
            'lokasi' => 'required',
            'hrgSatuan' => 'required',
        ]);

        $file = $inventaris->file;
        $file_name = $inventaris->file;

        if ($request->hasFile('file')) {
<<<<<<< HEAD
            if (Storage::exists('public/files/nota/' . $file)) {
                Storage::delete('public/files/nota/' . $file);
=======
            if (Storage::exists('public/files/' . $file)) {
                Storage::delete('public/files/' . $file);
>>>>>>> 58254bfc0e1bbd6e8adddb835398b9396d7feff5
            }
            $file = $request->file('file');
            $file_name = $request->kode . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/files', $file_name);
        }

        $inventaris->tgl_pembukuan = $request->input('pembukuan');
        $inventaris->kode = $request->input('kode');
        $inventaris->id_barang = $request->input('id_barang');
        $inventaris->deskripsi = $request->input('deskripsi');
        $inventaris->id_satuan = $request->input('id_satuan');
        $inventaris->thn_pembuatan = $request->input('pembuatan');
        $inventaris->id_dana = $request->input('id_dana');
        $inventaris->id_lokasi = $request->input('lokasi');
        $inventaris->tgl_penyerahan = $request->input('penyerahan');
        $inventaris->harga = $request->input('hrgSatuan');
        $inventaris->file = $file_name;
        $inventaris->id_user = Auth::id();

        $inventaris->save();



        return redirect()->route('inventaris.index')->with(['update' => 'Data Berhasil Diubah']);
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
        $inventaris->kondisi = $request->kondisi;
        $inventaris->save();
        return redirect()->route('inventaris.index')->with(['update' => 'Data Berhasil Diubah']);
    }

    // public function barang()
    // {
    //     $baik = DB::table('inventaris')
    //         ->select('kode', 'id_barang', 'jumlah', 'id_satuan', 'kondisi')
    //         ->where('kondisi', 1)->get();

    //     $rusak = DB::table('inventaris')
    //         ->select('kode', 'id_barang', 'jumlah', 'id_satuan', 'kondisi')
    //         ->where('kondisi', [2, 3])->get();

    //     dd($baik, $rusak);
    // }

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

    public function viewPdf(Inventaris $inventaris)
    {
        return view('admin.inventaris.pdf', [
            'inventaris' => $inventaris
        ]);
    }
}
