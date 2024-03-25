<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('supplychain.kategori.index', [
            'title' => 'Kelola Kategori',
            'kategoris' => Kategori::with('barang')->get()
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
    public function store(StoreKategoriRequest $request)
    {
        //
        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);
        Alert::success('Berhasil', 'Kategori Berhasil Ditambahkan!');
        return redirect()->to('/kategori');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori, string $id)
    {
        //
        return view('supplychain.kategori.edit', [
            'title' => 'Edit Kategori',
            'kategori'  => $kategori->findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriRequest $request, Kategori $kategori, string $id)
    {
        //
        $cek = $kategori->findOrFail($id);
        $cek->update([
            'nama_kategori' => $request->nama_kategori
        ]);
        Alert::success('Berhasil', 'Kategori Berhasil Diedit!');
        return redirect()->to('/kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori, string $id)
    {
        //
        $cek = $kategori->findOrFail($id);
        $cek->delete();
        Alert::success('Berhasil', 'Kategori Berhasil Dihapus!');
        return redirect()->to('/kategori');
    }
}
