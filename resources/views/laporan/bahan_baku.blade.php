@extends('layouts.main')
@section('content')
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">{{ $title }}</h5>
                        <p class="m-b-0">{{ $title }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/dashboard"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="/barang">{{ $title }}</a>
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
                            <h5>Data Barang</h5>
                            <div class="card-header-right d-flex align-items-center ">
                                <a href="/laporan_bahan_baku/cetak" class="btn btn-primary">
                                    <i class="ti-printer text-white "></i>
                                    Print</a>
                                <ul class="list-unstyled card-option">
                                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <table class="table table-hover w-100" id="datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Bahan Baku</th>
                                        <th>Harga</th>
                                        <th>Biaya Penyimpanan</th>
                                        <th>Stok</th>
                                        <th>Satuan</th>
                                        <th>Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bahan_bakus as $bahan_baku)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $bahan_baku->nama_barang }}</td>
                                            <td>Rp. {{ number_format($bahan_baku->harga, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($bahan_baku->biaya_penyimpanan, 0, ',', '.') }}</td>
                                            <td>{{ $bahan_baku->stok }}</td>
                                            <td>{{ $bahan_baku->satuan }}</td>
                                            <td>{{ $bahan_baku->kategori }}</td>
                                        </tr>
                                    @endforeach
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
@endsection
