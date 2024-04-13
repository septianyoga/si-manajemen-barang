<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;

class PermintaanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return Permintaan::with('permintaan_barang.barang')->get();
        return view('sales.permintaan_barang.index', [
            'title' => 'Permintaan Barang',
            'permintaans'   => Permintaan::with('permintaan_barang.barang')->get()
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
