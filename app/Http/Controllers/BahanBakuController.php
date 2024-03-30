<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBahanBakuRequest;
use App\Http\Requests\UpdateBahanBakuRequest;
use App\Models\BahanBaku;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('supplychain.bahan_baku.index', [
            'title' => 'Kelola Bahan Baku',
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
    public function store(StoreBahanBakuRequest $request)
    {
        //

        BahanBaku::create([
            'nama_barang'   => $request->nama_barang,
            'satuan'   => $request->satuan,
            'harga'   => $request->harga,
            'biaya_penyimpanan'   => $request->biaya_penyimpanan,
            'stok'   => $request->stok,
            'kategori'   => $request->kategori,
        ]);

        Alert::success('Berhasil', 'Bahan Baku Berhasil Ditambahkan!');
        return redirect()->to('/bahan_baku');
    }

    /**
     * Display the specified resource.
     */
    public function show(BahanBaku $bahanBaku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BahanBaku $bahanBaku, string $id)
    {
        //
        return view('supplychain.bahan_baku.edit', [
            'title' => 'Edit Bahan Baku',
            'bahan_baku'    => BahanBaku::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBahanBakuRequest $request, string $id)
    {
        //
        $bahan_baku = BahanBaku::findOrFail($id);

        $bahan_baku->update([
            'nama_barang'   => $request->nama_barang,
            'satuan'   => $request->satuan,
            'harga'   => $request->harga,
            'biaya_penyimpanan'   => $request->biaya_penyimpanan,
            'stok'   => $request->stok,
            'kategori'   => $request->kategori,
        ]);

        Alert::success('Berhasil', 'Bahan Baku Berhasil Diubah!');
        return redirect()->to('/bahan_baku');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BahanBaku $bahanBaku, string $id)
    {
        //
        $bahan_baku = $bahanBaku->findOrFail($id);
        $bahan_baku->delete();

        Alert::success('Berhasil', 'Bahan Baku Berhasil Dihapus!');
        return redirect()->to('/bahan_baku');
    }
}
