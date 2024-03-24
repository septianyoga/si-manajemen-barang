<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
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
        return view('admin.barang.index', [
            'title' => 'Kelola Barang',
            'barangs'   => Barang::with('kategori')->get(),
            'kategoris'  => Kategori::all()
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
        Barang::create([
            'nama_barang'   => $request->nama_barang,
            'harga_barang'   => $request->harga_barang,
            'stok_barang'   => $request->stok_barang,
            'status_barang'   => $request->status_barang,
            'kategori_id'   => $request->kategori_id,
        ]);

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
    public function edit(Barang $barang, string $id)
    {
        //
        return view('admin.barang.edit', [
            'title' => 'Edit Barang',
            'barang'    => $barang->findOrFail($id),
            'kategoris' => Kategori::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarangRequest $request, Barang $barang, string $id)
    {
        //
        $cek = $barang->findOrFail($id);
        $cek->update([
            'nama_barang'   => $request->nama_barang,
            'harga_barang'   => $request->harga_barang,
            'stok_barang'   => $request->stok_barang,
            'status_barang'   => $request->status_barang,
            'kategori_id'   => $request->kategori_id,
        ]);
        Alert::success('Berhasil', 'Data Barnag Berhasil Diedit!');
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
