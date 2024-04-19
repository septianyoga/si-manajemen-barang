<?php

namespace App\Http\Controllers;

use App\Models\StockOpname;
use App\Http\Requests\StoreStockOpnameRequest;
use App\Http\Requests\UpdateStockOpnameRequest;
use App\Models\Barang;
use RealRashid\SweetAlert\Facades\Alert;

class StockOpnameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('supplychain.stock_opname.index', [
            'title' => 'Kelola Stock Opname',
            'stock_opnames' => StockOpname::with('barang')->get(),
            'barangs'   => Barang::all()
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
    public function store(StoreStockOpnameRequest $request)
    {
        //
        $stok = [
            'jumlah'    => $request->jumlah,
            'status'    => $request->status,
            'barang_id' => $request->barang_id
        ];

        $barang = Barang::findOrFail($request->barang_id);
        if ($request->jumlah > $barang->stok_barang) {
            Alert::warning('Gagal', 'Jumlah tidak boleh melebihi stok barang saat ini!');
            return redirect()->to('/stock_opname');
        }
        StockOpname::create($stok);

        $barang->update([
            'stok_barang'   => $barang->stok_barang - $request->jumlah
        ]);

        Alert::success('Berhasil', 'Stock Opname Berhasil Ditambahkan!');
        return redirect()->to('/stock_opname');
    }

    /**
     * Display the specified resource.
     */
    public function show(StockOpname $stockOpname)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockOpname $stockOpname)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockOpnameRequest $request, StockOpname $stockOpname, string $id)
    {
        //
        $stok = [
            'jumlah'    => $request->jumlah,
            'status'    => $request->status,
        ];

        $stock_opname = StockOpname::findOrFail($id);

        $barang = Barang::findOrFail($stock_opname->barang_id);

        if ($request->jumlah > $barang->stok_barang + $stockOpname->jumlah) {
            Alert::warning('Gagal', 'Jumlah tidak boleh melebihi stok barang saat ini!');
            return redirect()->to('/stock_opname');
        }

        $barang->update([
            'stok_barang'   => ($barang->stok_barang + $stock_opname->jumlah) - $request->jumlah
        ]);

        $stock_opname->update($stok);


        Alert::success('Berhasil', 'Stock Opname Berhasil Diubah!');
        return redirect()->to('/stock_opname');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockOpname $stockOpname, string $id)
    {
        //
        $stock_opname = StockOpname::findOrFail($id);
        $barang = Barang::findOrFail($stock_opname->barang_id);

        $barang->update([
            'stok_barang'   => $barang->stok_barang + $stock_opname->jumlah
        ]);

        $stock_opname->delete();
        Alert::success('Berhasil', 'Stock Opname Berhasil Dihapus!');
        return redirect()->to('/stock_opname');
    }
}
