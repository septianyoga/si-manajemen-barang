<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Barang;
use App\Models\PermintaanBarang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SafetyStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $permintaan_barang = PermintaanBarang::with(['barang.barang_bahan_baku.bahan_baku', 'permintaan'])->whereHas('permintaan', function ($query) {
        //     $query->whereYear('tanggal_dibutuhkan', 2024);
        // })->where('barang_id', 6)->get();
        // return $permintaan_barang;
        // $bahan_baku = BahanBaku::with('barang_bahan_baku.barang.permintaan_barang.permintaan')->get();
        // ->whereHas('barang_bahan_baku.barang.permintaan_barang.permintaan', function ($query) {
        //     $query->whereYear('tanggal_dibutuhkan', 2023);
        // })->get();
        $bahan_baku = BahanBaku::with([
            'barang_bahan_baku.barang.permintaan_barang.permintaan' => function ($query) {
                $query->whereYear('tanggal_dibutuhkan', date('Y') - 1);
            }
        ])->get();
        // return $bahan_baku;

        // $jumlah_barang_terbanyak = 0;
        // foreach ($bahan_baku as $bahan) {
        //     foreach ($bahan->barang_bahan_baku as $barang_bahan_baku) {
        //         if ($barang_bahan_baku->barang->permintaan_barang) {
        //             foreach ($barang_bahan_baku->barang->permintaan_barang as $permintaan_barang) {
        //                 if ($permintaan_barang->jumlah_barang > $jumlah_barang_terbanyak && $permintaan_barang->permintaan != null) {
        //                     $jumlah_barang_terbanyak = $permintaan_barang->jumlah_barang;
        //                 }
        //             }
        //         }
        //     }
        // }
        // return $jumlah_barang_terbanyak;

        // $total_jumlah_barang = 0;
        // $total_permintaan = 0;
        // foreach ($bahan_baku as $bahan) {
        //     foreach ($bahan->barang_bahan_baku as $barang_bahan_baku) {
        //         if ($barang_bahan_baku->barang->permintaan_barang) {
        //             foreach ($barang_bahan_baku->barang->permintaan_barang as $permintaan_barang) {
        //                 if ($permintaan_barang->jumlah_barang && $permintaan_barang->permintaan != null) {
        //                     $total_jumlah_barang += $permintaan_barang->jumlah_barang;
        //                     $total_permintaan++;
        //                 }
        //             }
        //         }
        //     }
        // }
        // $rata_rata_jumlah_barang = $total_jumlah_barang / $total_permintaan;
        // return $rata_rata_jumlah_barang;

        return view('supplychain.safety_stock.index', [
            'title' => 'Hitung Safety Stock & ROP',
            'bahan_bakus'   => $bahan_baku
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
        $bahan_baku = BahanBaku::with([
            'barang_bahan_baku.barang.permintaan_barang.permintaan' => function ($query) {
                $query->whereYear('tanggal_dibutuhkan', date('Y') - 1);
            }
        ])->find($id);

        $jumlah_barang_terbanyak = 0;
        foreach ($bahan_baku->barang_bahan_baku as $barang_bahan_baku) {
            if ($barang_bahan_baku->barang->permintaan_barang) {
                foreach ($barang_bahan_baku->barang->permintaan_barang as $permintaan_barang) {
                    if ($permintaan_barang->jumlah_barang > $jumlah_barang_terbanyak && $permintaan_barang->permintaan != null) {
                        $jumlah_barang_terbanyak = $permintaan_barang->jumlah_barang;
                    }
                }
            }
        }
        // return $jumlah_barang_terbanyak;

        $total_jumlah_barang = 0;
        $total_permintaan = 0;
        foreach ($bahan_baku->barang_bahan_baku as $barang_bahan_baku) {
            if ($barang_bahan_baku->barang->permintaan_barang) {
                foreach ($barang_bahan_baku->barang->permintaan_barang as $permintaan_barang) {
                    if ($permintaan_barang->jumlah_barang && $permintaan_barang->permintaan != null) {
                        $total_jumlah_barang += $permintaan_barang->jumlah_barang;
                        $total_permintaan++;
                    }
                }
            }
        }
        $rata_rata_jumlah_barang = $total_jumlah_barang / $total_permintaan;
        // return $rata_rata_jumlah_barang;

        $safety_stock = ($jumlah_barang_terbanyak - $rata_rata_jumlah_barang) * $request->lead_time;
        $bahan_baku->update([
            'lead_time' => $request->lead_time,
            'safety_stock'  => $safety_stock
        ]);
        Alert::success('Berhasil', 'Safety Stock Berhasil Dihitung!');
        return redirect()->to('safety_stock');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function hitungROP(string $id)
    {
        $bahan_baku = BahanBaku::with([
            'barang_bahan_baku.barang.permintaan_barang.permintaan' => function ($query) {
                $query->whereYear('tanggal_dibutuhkan', date('Y') - 1);
            }
        ])->find($id);

        $total_jumlah_barang = 0;
        foreach ($bahan_baku->barang_bahan_baku as $barang_bahan_baku) {
            if ($barang_bahan_baku->barang->permintaan_barang) {
                foreach ($barang_bahan_baku->barang->permintaan_barang as $permintaan_barang) {
                    if ($permintaan_barang->jumlah_barang && $permintaan_barang->permintaan != null) {
                        $total_jumlah_barang += $permintaan_barang->jumlah_barang;
                    }
                }
            }
        }
        $rop = ($total_jumlah_barang * $bahan_baku->lead_time) + $bahan_baku->safety_stock;
        $bahan_baku->update(['rop' => $rop]);
        Alert::success('Berhasil', 'Reorder Point Berhasil Dihitung!');
        return redirect()->to('safety_stock');
    }
}
