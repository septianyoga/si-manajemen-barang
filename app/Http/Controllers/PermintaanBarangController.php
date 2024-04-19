<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keuangan;
use App\Models\Permintaan;
use App\Models\PermintaanBarang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
            'permintaans'   => Permintaan::with('permintaan_barang.barang')->get(),
            'barangs'       => Barang::all()
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

        // Membersihkan array "jumlah" dengan menghilangkan entri yang memiliki nilai "0"
        $jumlah_clean = array_filter($request->jumlah_barang, function ($value, $key) {
            return $value != "0";
        }, ARRAY_FILTER_USE_BOTH);

        // Mengatur ulang kunci array untuk memastikan urutan kunci yang benar
        $jumlah_clean = array_values($jumlah_clean);

        // Update array "jumlah" dengan data yang sudah dibersihkan
        $request->merge([
            'jumlah_barang' => $jumlah_clean
        ]);

        $jumlah_barang = 0;
        $total_harga = 0;
        foreach ($request->jumlah_barang as $key => $jumlah) {
            $get_harga = Barang::findOrFail($request->barang[$key]);
            $total_harga += $get_harga->harga_barang * $jumlah;
            $jumlah_barang += $jumlah;
        }

        $permintaan = Permintaan::create([
            'tanggal_dibutuhkan'    => $request->tanggal_dibutuhkan,
            'total_barang'          => $jumlah_barang,
            'total_harga'           => $total_harga,
            'satus_permintaan'      => 'Menunggu Approve'
        ]);

        $permintaan_id = $permintaan->id;
        foreach ($request->barang as $key => $barang) {
            # code...
            $harga_barang = Barang::findOrFail($barang);
            PermintaanBarang::create([
                'permintaan_id' => $permintaan_id,
                'barang_id'     => $barang,
                'harga'         => $harga_barang->harga_barang,
                'jumlah_barang' => $request->jumlah_barang[$key]
            ]);
        }

        Alert::success('Berhasil', 'Permintaan Barang Berhasil Ditambahkan!');
        return redirect()->to('/permintaan_barang');
        // dd($jumlah_barang . '   ' . $total_harga);
        // dd($request->all());
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

    public function approvePermintaan()
    {
        return view('supplychain.approve_permintaan.index', [
            'title'         => 'Approve Permintaan Barang',
            'permintaans'   => Permintaan::with('permintaan_barang.barang')->get(),
            'barangs'       => Barang::all()
        ]);
    }

    public function prosesApprove(string $id)
    {
        $permintaan = Permintaan::with('permintaan_barang.barang')->findOrFail($id);
        // return $permintaan;
        $permintaan->update([
            'status_permintaan' => 'Dikonfirmasi'
        ]);
        foreach ($permintaan->permintaan_barang as $minta) {
            $barang = Barang::findOrFail($minta->barang_id);
            $barang->update([
                'stok_barang'   => $barang->stok_barang - $minta->jumlah_barang
            ]);
        }

        $keuangan = [
            'keterangan' => 'Permintaan Barang',
            'kategori'  => 'Pemasukan',
            'biaya' => $permintaan->total_harga,
            'permintaan_id'  => $id
        ];

        Keuangan::create($keuangan);

        Alert::success('Berhasil', 'Approve Permintaan Barang Berhasil!');
        return redirect()->to('/approve_permintaan');
    }

    public function selesai(string $id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $permintaan->update([
            'status_permintaan' => 'Selesai'
        ]);
        Alert::success('Berhasil', 'Permintaan Barang Berhasil Diselesaikan!');
        return redirect()->to('/permintaan_barang');
    }
}
