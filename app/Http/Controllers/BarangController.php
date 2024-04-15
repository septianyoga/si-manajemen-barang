<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\BahanBaku;
use App\Models\BarangBahanBaku;
use App\Models\Kategori;
use App\Models\Pemesanan;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return Barang::with('barang_bahan_baku.bahan_baku')->get();
        return view('supplychain.barang.index', [
            'title' => 'Kelola Barang',
            'barangs'   => Barang::with('barang_bahan_baku.bahan_baku')->get(),
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
    public function store(StoreBarangRequest $request)
    {
        //
        $barang = Barang::create([
            'nama_barang'   => $request->nama_barang,
            'harga_barang'   => $request->harga_barang,
            'stok_barang'   => $request->stok_barang,
            'status_barang'   => $request->status_barang,
        ]);

        if ($request->bahan) {

            // Membersihkan array "jumlah" dengan menghilangkan entri yang memiliki nilai "0"
            $jumlah_clean = array_filter($request->jumlah, function ($value, $key) {
                return $value != "0";
            }, ARRAY_FILTER_USE_BOTH);

            // Mengatur ulang kunci array untuk memastikan urutan kunci yang benar
            $jumlah_clean = array_values($jumlah_clean);

            // Update array "jumlah" dengan data yang sudah dibersihkan
            $request->merge([
                'jumlah' => $jumlah_clean
            ]);

            foreach ($request->bahan as $key => $bahan_id) {
                # code...
                BarangBahanBaku::create([
                    'barang_id' => $barang->id,
                    'bahan_baku_id' => $bahan_id,
                    'jumlah'    => $request->jumlah[$key]
                ]);
                // update stock
                $bahan = BahanBaku::findOrFail($bahan_id);
                $bahan->update([
                    'stok' => $bahan->stok - $request->jumlah[$key]
                ]);
            }
        }

        Alert::success('Berhasil', 'Barang Berhasil Ditambahkan!');
        return redirect()->to('/barang');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $barang->load('barang_bahan_baku'); // Memuat relasi barang_bahan_baku

        $bahan_bakus = BahanBaku::all();

        // return $barang;

        return view('supplychain.barang.edit', [
            'title' => 'Edit Barang',
            'barang' => $barang,
            'bahan_bakus' => $bahan_bakus
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarangRequest $request, Barang $barang, string $id)
    {
        $barang_baku = $barang->findOrFail($id);

        // return $barang_baku->barang_bahan_baku;

        $barang_baku->update([
            'nama_barang'   => $request->nama_barang,
            'harga_barang'   => $request->harga_barang,
            'stok_barang'   => $request->stok_barang,
            'status_barang'   => $request->status_barang,
        ]);

        if ($request->bahan) {
            // kembaliin stok awal bahan sebelum dihapus
            foreach ($barang_baku->barang_bahan_baku as $brg) {
                $bahan = BahanBaku::findOrFail($brg->bahan_baku_id);
                $bahan->update([
                    'stok'  => $bahan->stok + $brg->jumlah
                ]);
            }
            // Hapus entri barang_bahan_baku yang terkait dengan barang yang sedang diupdate
            $barang_baku->barang_bahan_baku()->delete();

            // Membersihkan array "jumlah" dengan menghilangkan entri yang memiliki nilai "0"
            $jumlah_clean = array_filter($request->jumlah, function ($value, $key) {
                return $value != "0";
            }, ARRAY_FILTER_USE_BOTH);

            // Mengatur ulang kunci array untuk memastikan urutan kunci yang benar
            $jumlah_clean = array_values($jumlah_clean);

            // Update array "jumlah" dengan data yang sudah dibersihkan
            $request->merge([
                'jumlah' => $jumlah_clean
            ]);

            // dd($request->all());

            foreach ($request->bahan as $key => $bahan_id) {

                // Tambahkan kembali entri barang_bahan_baku yang baru
                BarangBahanBaku::create([
                    'barang_id' => $barang_baku->id,
                    'bahan_baku_id' => $bahan_id,
                    'jumlah' => $request->jumlah[$key]
                ]);
                $bhn = BahanBaku::findOrFail($bahan_id);
                $bhn->update([
                    'stok' => $bhn->stok - $request->jumlah[$key]
                ]);
            }
            // dd($request->all());
        }

        Alert::success('Berhasil', 'Barang Berhasil Diubah!');
        return redirect()->to('/barang');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang, string $id)
    {
        //
        $cek = $barang->findOrFail($id);
        // kembaliin stok bahannya dulu
        foreach ($cek->barang_bahan_baku as $brg) {
            $bahan = BahanBaku::findOrFail($brg->bahan_baku_id);
            $bahan->update([
                'stok'  => $bahan->stok + $brg->jumlah
            ]);
        }
        $cek->barang_bahan_baku()->delete();
        $cek->delete();
        Alert::success('Berhasil', 'Data Barang Berhasil Dihapus!');
        return redirect()->to('/barang');
    }

    public function tambahStok(Request $request, string $id)
    {
        $barang = Barang::with('barang_bahan_baku.bahan_baku')->findOrFail($id);
        foreach ($barang->barang_bahan_baku as $key => $bahan) {
            # code...
            $baku = BahanBaku::findOrFail($bahan->bahan_baku_id);
            $baku->update([
                'stok'  => $baku->stok - ($request->jumlah * $bahan->jumlah)
            ]);
        }
        $barang->update([
            'stok_barang'   => $barang->stok_barang + $request->jumlah
        ]);
        Alert::success('Berhasil', 'Stok Barang Berhasil Ditambah!');
        return redirect()->to('/barang/' . $id);
    }

    public function kurangStok(Request $request, string $id)
    {
        $barang = Barang::with('barang_bahan_baku.bahan_baku')->findOrFail($id);
        foreach ($barang->barang_bahan_baku as $key => $bahan) {
            # code...
            $baku = BahanBaku::findOrFail($bahan->bahan_baku_id);
            $baku->update([
                'stok'  => $baku->stok + ($request->jumlah * $bahan->jumlah)
            ]);
        }
        $barang->update([
            'stok_barang'   => $barang->stok_barang - $request->jumlah
        ]);
        Alert::success('Berhasil', 'Stok Barang Berhasil Dikurangi!');
        return redirect()->to('/barang/' . $id);
        $barang = Barang::with('barang_bahan_baku')->findOrFail($id);
    }

    public function barangMasuk()
    {
        // return Pemesanan::with('bahan_baku', 'supplier')->where('status', 'Selesai')->get();
        return view('supplychain.barang_masuk.index', [
            'title' => 'Barang Masuk',
            'barang_masuk'  => Pemesanan::with('bahan_baku', 'supplier')->where('status', 'Selesai')->get()
        ]);
    }

    public function barangKeluar()
    {
        // return Permintaan::with('permintaan_barang.barang')->where('status_permintaan', 'Selesai')->get();
        return view('supplychain.barang_keluar.index', [
            'title' => 'Barang Keluar',
            'barang_keluar' => Permintaan::with('permintaan_barang.barang')->where('status_permintaan', 'Selesai')->get()
        ]);
    }
}
