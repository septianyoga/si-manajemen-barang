<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Http\Requests\StoreKeuanganRequest;
use App\Http\Requests\UpdateKeuanganRequest;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return Keuangan::with(['pemesanan.bahan_baku', 'permintaan.permintaan_barang.barang'])->get();
        $pemasukan = Keuangan::where('kategori', 'pemasukan')->sum('biaya');
        $pengeluaran = Keuangan::where('kategori', 'pengeluaran')->sum('biaya');

        $uang_saat_ini = $pemasukan - $pengeluaran;

        return view('finance.keuangan.index', [
            'title' => 'Keuangan',
            'keuangans' => Keuangan::with(['pemesanan.bahan_baku', 'permintaan.permintaan_barang.barang'])->get(),
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'uang_saat_ini' => $uang_saat_ini
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
    public function store(StoreKeuanganRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Keuangan $keuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keuangan $keuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeuanganRequest $request, Keuangan $keuangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keuangan $keuangan)
    {
        //
    }
}
