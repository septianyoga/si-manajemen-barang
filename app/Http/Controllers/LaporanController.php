<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Barang;
use App\Models\Pemesanan;
use App\Models\Permintaan;
use App\Models\StockOpname;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    //

    public function laporanPemesanan()
    {
        return view('laporan.pemesanan', [
            'title' => 'Laporan Pemesanan Barang',
            'pemesanans'    => Pemesanan::with(['bahan_baku', 'supplier'])->get()
        ]);
    }

    public function cetakPemesanan()
    {
        $pemesanan = Pemesanan::with(['bahan_baku', 'supplier'])->get();

        $pdf = Pdf::loadView('cetak.pemesanan', [
            'title' => 'Cetak Pemesanan',
            'pemesanans' => $pemesanan,
        ])->setPaper('A4', 'landscape')->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true, 'isJavascriptEnabled' => true
        ]);
        // return $pdf->download('PO000' . $id . '.pdf');
        return $pdf->stream('print.pdf');
        // return view('cetak.cetak_po', [
        //     'title' => 'Cetak PO',
        //     'pemesanan' => $pemesanan
        // ]);
    }

    public function laporanPermintaan()
    {
        return view('laporan.permintaan', [
            'title' => 'Laporan Permintaan Barang',
            'permintaans'   => Permintaan::with('permintaan_barang.barang')->get()
        ]);
    }

    public function cetakPermintaan()
    {
        $permintaan = Permintaan::with('permintaan_barang.barang')->get();

        $pdf = Pdf::loadView('cetak.permintaan', [
            'title' => 'Cetak Permintaan',
            'permintaans' => $permintaan,
        ])->setPaper('A4', 'landscape')->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true, 'isJavascriptEnabled' => true
        ]);
        // return $pdf->download('PO000' . $id . '.pdf');
        return $pdf->stream('print.pdf');
        // return view('cetak.cetak_po', [
        //     'title' => 'Cetak PO',
        //     'pemesanan' => $pemesanan
        // ]);
    }

    public function laporanBarang()
    {
        return view('laporan.barang', [
            'title' => 'Laporan Barang',
            'barangs'   => Barang::with('barang_bahan_baku.bahan_baku')->get()
        ]);
    }

    public function cetakBarang()
    {
        $barang = Barang::with('barang_bahan_baku.bahan_baku')->get();

        $pdf = Pdf::loadView('cetak.barang', [
            'title' => 'Cetak Barang',
            'barangs' => $barang,
        ])->setPaper('A4', 'landscape')->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true, 'isJavascriptEnabled' => true
        ]);
        // return $pdf->download('PO000' . $id . '.pdf');
        return $pdf->stream('print.pdf');
        // return view('cetak.cetak_po', [
        //     'title' => 'Cetak PO',
        //     'pemesanan' => $pemesanan
        // ]);
    }

    public function laporanBahanBaku()
    {
        // return BahanBaku::with('barang_bahan_baku.barang')->get();
        return view('laporan.bahan_baku', [
            'title' => 'Laporan Bahan Baku',
            'bahan_bakus'   => BahanBaku::with('barang_bahan_baku.barang')->get()
        ]);
    }

    public function cetakBahanBaku()
    {
        $bahan_baku = BahanBaku::with('barang_bahan_baku.barang')->get();

        $pdf = Pdf::loadView('cetak.bahan_baku', [
            'title' => 'Cetak Bahan Baku',
            'bahan_bakus' => $bahan_baku,
        ])->setPaper('A4', 'landscape')->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true, 'isJavascriptEnabled' => true
        ]);
        // return $pdf->download('PO000' . $id . '.pdf');
        return $pdf->stream('print.pdf');
        // return view('cetak.cetak_po', [
        //     'title' => 'Cetak PO',
        //     'pemesanan' => $pemesanan
        // ]);
    }

    public function laporanStockOpname()
    {
        return view('laporan.stock_opname', [
            'title' => 'Laporan Stock Opname',
            'stock_opnames' => StockOpname::with('barang')->get()
        ]);
    }

    public function cetakStockOpname()
    {
        $stock_opname = StockOpname::with('barang')->get();

        $pdf = Pdf::loadView('cetak.stock_opname', [
            'title' => 'Cetak Stock Opname',
            'stock_opnames' => $stock_opname,
        ])->setPaper('A4')->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true, 'isJavascriptEnabled' => true
        ]);
        // return $pdf->download('PO000' . $id . '.pdf');
        return $pdf->stream('print.pdf');
        // return view('cetak.cetak_po', [
        //     'title' => 'Cetak PO',
        //     'pemesanan' => $pemesanan
        // ]);
    }
}
