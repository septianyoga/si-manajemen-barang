<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class EOQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('supplychain.eoq.index', [
            'title' => 'Hitung EOQ',
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
        return view('supplychain.eoq.hitung', [
            'title' => 'Hitung EOQ',
            'bahan_baku'    => BahanBaku::with('pemesanan')->findOrFail($id),
            'jumlah_permintaan' => Pemesanan::whereYear('tgl_pesan', date('Y') - 1)->where('bahan_baku_id', $id)->avg('jumlah_barang')
        ]);
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
    }
}
