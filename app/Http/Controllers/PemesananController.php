<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Http\Requests\StorePemesananRequest;
use App\Http\Requests\UpdatePemesananRequest;
use App\Models\BahanBaku;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('supplychain.pemesanan.index', [
            'title' => 'Pemesanan',
            'pemesanans'    => Pemesanan::with(['bahan_baku', 'supplier'])->get(),
            'bahan_bakus'   => BahanBaku::all(),
            'suppliers'     => Supplier::all()
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
    public function store(StorePemesananRequest $request)
    {
        //
        Pemesanan::create([
            'bahan_baku_id' => $request->bahan_baku_id,
            'jumlah_barang' => $request->jumlah_barang,
            'total_harga' => $request->total_harga,
            'tgl_pesan' => $request->tgl_pesan,
            'supplier_id' => $request->supplier_id,
        ]);

        Alert::success('Berhasil', 'Pemesanan Berhasil Dibuat!');
        return redirect()->to('/pemesanan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePemesananRequest $request, Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemesanan $pemesanan)
    {
        //
    }

    public function konfirmasi(string $id)
    {
        $pemesanan = Pemesanan::with('supplier')->findOrFail($id);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => '0895330930059',
                'message' => 'Halo ' . $pemesanan->supplier->nama_supplier . '! Kami telah melakukan pemesanan barang kepada anda. Berikut adalah link Purchase Order untuk informasi lebih detail dari barang yang dipesan. ' . asset('po/contoh_po.pdf'),
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: JsCKnP7xQtwWR@YGruJM' //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        $pemesanan->update([
            'status'    => 'Dalam Proses'
        ]);

        Alert::success('Berhasil', 'Berhasil Konfirmasi Supplier!');
        return redirect()->to('/pemesanan');
    }

    public function selesai(string $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update([
            'status'    => 'Selesai',
            'tgl_masuk' => date('Y-m-d')
        ]);

        $bahan = BahanBaku::findOrFail($pemesanan->bahan_baku_id);
        $bahan->update([
            'stok'  => $bahan->stok + $pemesanan->jumlah_barang
        ]);

        Alert::success('Berhasil', 'Pemesanan Berhasil Diselesaikan!');
        return redirect()->to('/pemesanan');
    }

    public function cetakPO(string $id)
    {
        $pemesanan = Pemesanan::with(['bahan_baku', 'supplier'])->findOrFail($id);

        $pdf = Pdf::loadView('cetak.cetak_po', [
            'pemesanan' => $pemesanan,
        ])->setPaper('A4')->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true, 'isJavascriptEnabled' => true
        ]);
        // return $pdf->download('tiket-' . $id . '.pdf');
        return $pdf->stream('tiket.pdf');
        // return view('cetak.cetak_po', [
        //     'title' => 'Cetak PO',
        //     'pemesanan' => $pemesanan
        // ]);
    }
}
