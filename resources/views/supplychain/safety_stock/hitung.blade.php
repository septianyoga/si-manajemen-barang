@extends('layouts.main')
@section('content')
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Hitung Bahan Barang : {{ $bahan_baku->nama_barang }}</h5>
                        <p class="m-b-0">EOQ</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/dashboard"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="/eoq">EOQ</a>
                        <li class="breadcrumb-item"><a href="/eoq/{{ $bahan_baku->id }}">{{ $title }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <!-- Hover table card start -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Bahan Barang</h5>
                            <div class="card-header-right d-flex align-items-center ">
                                <ul class="list-unstyled card-option">
                                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <div>
                                <p>Nama Bahan : {{ $bahan_baku->nama_barang }}</p>
                                <p>Biaya Penyimpanan : Rp. {{ number_format($bahan_baku->biaya_penyimpanan, 0, ',', '.') }}
                                </p>
                                <p>Jumlah Permintaan : {{ $jumlah_permintaan }} {{ $bahan_baku->satuan }} / tahun</p>
                            </div>
                            <table class="table table-hover w-100" id="datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Q</th>
                                        <th>Rata2 Persediaan</th>
                                        <th class="text-right">Biaya Penyimpanan</th>
                                        <th>Frekuensi Pemesanan</th>
                                        <th class="text-right">Biaya Pemesanan</th>
                                        <th>Total Biaya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $minDifference = PHP_INT_MAX; // Inisialisasi selisih minimum dengan nilai maksimum dari tipe data integer
                                        $minDifferenceIndex = -1; // Index dari baris dengan selisih minimum
                                        $index = 0; // Index baris
                                    @endphp
                                    @foreach ($bahan_baku->pemesanan as $pesan)
                                        @php
                                            // Perhitungan biaya penyimpanan dan biaya pemesanan
                                            $biayaPenyimpanan =
                                                ($pesan->jumlah_barang / 2) * $bahan_baku->biaya_penyimpanan;
                                            $biayaPemesanan =
                                                ($jumlah_permintaan / $pesan->jumlah_barang) * $pesan->total_harga;
                                            // Perhitungan selisih
                                            $selisih = abs($biayaPenyimpanan - $biayaPemesanan);
                                            // Memeriksa apakah selisih baru lebih kecil dari selisih minimum sebelumnya
                                            if ($selisih < $minDifference) {
                                                $minDifference = $selisih;
                                                $minDifferenceIndex = $index;
                                            }
                                            $index++;
                                        @endphp
                                        <tr @if ($index - 1 == $minDifferenceIndex) class="table-success" @endif>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pesan->jumlah_barang }}</td>
                                            <td>{{ $pesan->jumlah_barang / 2 }}</td>
                                            <td class="text-right">Rp.{{ number_format($biayaPenyimpanan, 0, ',', '.') }}
                                            </td>
                                            <td>{{ $jumlah_permintaan / $pesan->jumlah_barang }}</td>
                                            <td class="text-right">Rp.{{ number_format($biayaPemesanan, 0, ',', '.') }}
                                            </td>
                                            <td class="text-right">
                                                Rp.{{ number_format($biayaPenyimpanan + $biayaPemesanan, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- @foreach ($bahan_baku->pemesanan as $pesan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pesan->jumlah_barang }}</td>
                                            <td>{{ $pesan->jumlah_barang / 2 }}</td>
                                            <td class="text-right">Rp.
                                                {{ number_format(($pesan->jumlah_barang / 2) * $bahan_baku->biaya_penyimpanan, 0, ',', '.') }}
                                            </td>
                                            <td>{{ $jumlah_permintaan / $pesan->jumlah_barang }}</td>
                                            <td class="text-right">Rp.
                                                {{ number_format(($jumlah_permintaan / $pesan->jumlah_barang) * $pesan->total_harga, 0, ',', '.') }}
                                            </td>
                                            <td class="text-right">Rp.
                                                {{ number_format(($pesan->jumlah_barang / 2) * $bahan_baku->biaya_penyimpanan + ($jumlah_permintaan / $pesan->jumlah_barang) * $pesan->total_harga, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Hover table card end -->
                    <!-- Background Utilities table end -->
                </div>
                <!-- Page-body end -->
            </div>
        </div>
        <!-- Main-body end -->
    </div>
    {{-- modal --}}
@endsection
