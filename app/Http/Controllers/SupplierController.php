<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('supplychain.supplier.index', [
            'title' => 'Kelola Supplier',
            'suppliers' => Supplier::all()
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
    public function store(StoreSupplierRequest $request)
    {
        //
        Supplier::create([
            'nama_supplier' => $request->nama_supplier,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
        ]);
        Alert::success('Berhasil', 'Supplier Berhasil Ditambahkan!');
        return redirect()->to('/supplier');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier, string $id)
    {
        //
        return view('supplychain.supplier.edit', [
            'title' => 'Edit Supplier',
            'supplier'  => $supplier->findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier, string $id)
    {
        //
        $cek = $supplier->findOrFail($id);
        $cek->update([
            'nama_supplier' => $request->nama_supplier,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
        ]);
        Alert::success('Berhasil', 'Data Supplier Berhasil Diedit!');
        return redirect()->to('/supplier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier, string $id)
    {
        //
        $cek = $supplier->findOrFail($id);
        $cek->delete();
        Alert::success('Berhasil', 'Data Supplier Berhasil Dihapus!');
        return redirect()->to('/supplier');
    }
}
