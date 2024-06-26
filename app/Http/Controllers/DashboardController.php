<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Barang;
use App\Models\Pemesanan;
use App\Models\Permintaan;
use App\Models\StockOpname;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'total' => [
                'user'  => User::count(),
                'barang'    => Barang::count(),
                'bahan_baku'    => BahanBaku::count(),
                'stok_opname'   => StockOpname::count(),
                'supplier'      => Supplier::count(),
                'pemesanan'     => Pemesanan::count()
            ],
            'pemesanans' => Pemesanan::with(['supplier', 'bahan_baku'])->orderBy('id', 'DESC')->limit(4)->get(),
            'permintaans'    => Permintaan::with('permintaan_barang.barang')->orderBy('id', 'DESC')->limit(4)->get()
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
    }
}
