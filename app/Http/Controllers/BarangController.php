<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\BahanBaku;
use App\Models\BarangBahanBaku;
use App\Models\Kategori;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return Barang::with('barang_bahan_baku.bahan_baku')->get();
        return view('supplychain.barang.index', [
            'title' => 'Kelola Barang',
            'barangs'   => Barang::with('barang_bahan_baku.bahan_baku')->get(),
            'bahan_bakus'   => BahanBaku::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBarangRequest $request)
    {
        //
        $barang = Barang::create([
            'nama_barang'   => $request->nama_barang,
            'harga_barang'   => $request->harga_barang,
            'stok_barang'   => $request->stok_barang,
            'status_barang'   => $request->status_barang,
        ]);

        if ($request->bahan) {
            foreach ($request->bahan as $key => $bahan_id) {
                # code...
                BarangBahanBaku::create([
                    'barang_id' => $barang->id,
                    'bahan_baku_id' => $bahan_id,
                    'jumlah'    => $request->jumlah[$key]
                ]);
            }
        }

        Alert::success('Berhasil', 'Barang Berhasil Ditambahkan!');
        return redirect()->to('/barang');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $barang->load('barang_bahan_baku'); // Memuat relasi barang_bahan_baku

        $bahan_bakus = BahanBaku::all();

        // return $barang;

        return view('supplychain.barang.edit', [
            'title' => 'Edit Barang',
            'barang' => $barang,
            'bahan_bakus' => $bahan_bakus
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarangRequest $request, Barang $barang, string $id)
    {
        $barang_baku = $barang->findOrFail($id);
        $barang_baku->update([
            'nama_barang'   => $request->nama_barang,
            'harga_barang'   => $request->harga_barang,
            'stok_barang'   => $request->stok_barang,
            'status_barang'   => $request->status_barang,
        ]);

        if ($request->bahan) {
            // Hapus entri barang_bahan_baku yang terkait dengan barang yang sedang diupdate
            $barang_baku->barang_bahan_baku()->delete();
            foreach ($request->bahan as $key => $bahan_id) {
                // Tambahkan kembali entri barang_bahan_baku yang baru
                BarangBahanBaku::create([
                    'barang_id' => $barang_baku->id,
                    'bahan_baku_id' => $bahan_id,
                    'jumlah' => $request->jumlah[$key]
                ]);
            }
        }

        Alert::success('Berhasil', 'Barang Berhasil Diubah!');
        return redirect()->to('/barang');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang, string $id)
    {
        //
        $cek = $barang->findOrFail($id);
        $cek->delete();
        Alert::success('Berhasil', 'Data Barang Berhasil Dihapus!');
        return redirect()->to('/barang');
    }
}
