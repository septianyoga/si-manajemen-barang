<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ApprovePesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('finance.pemesanan.approve', [
            'title' => 'Approve Pesanan Barang',
            'pemesanans'    => Pemesanan::with(['bahan_baku', 'supplier'])->get(),
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pesanan = Pemesanan::with('bahan_baku')->findOrFail($id);
        $pesanan->update([
            'status'    => 'Menunggu Konfirmasi'
        ]);

        // insert ke tbl keuangan
        $keuangan = [
            'keterangan' => 'Pemesanan Bahan Baku ' . $pesanan->bahan_baku->nama_barang,
            'kategori'  => 'Pengeluaran',
            'biaya' => $pesanan->total_harga,
            'pemesanan_id'  => $id
        ];

        Keuangan::create($keuangan);

        Alert::success('Berhasil', 'Pesanan Berhasil Diapprove!');
        return redirect()->to('/approve_pesanan');
    }

    public function reject(Request $request)
    {
        dd($request);
    }
}
