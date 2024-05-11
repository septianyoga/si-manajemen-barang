@extends('layouts.main')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Dashboard</h5>
                        <p class="m-b-0">Welcome to Management Inventory System</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="/dasboard">Dashboard</a>
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
                    <div class="row">
                        <!-- Material statustic card start -->
                        <div class="col-xl-6 col-md-12">
                            <div class="card mat-stat-card">
                                <div class="card-block">
                                    <div class="row align-items-center b-b-default">
                                        <div class="col-sm-6 b-r-default p-b-20 p-t-20">
                                            <div class="row align-items-center text-center">
                                                <div class="col-4 p-r-0">
                                                    <i class="far fa-user text-c-purple f-24"></i>
                                                </div>
                                                <div class="col-8 p-l-0">
                                                    <h5>{{ $total['user'] }}</h5>
                                                    <p class="text-muted m-b-0">Users</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 p-b-20 p-t-20">
                                            <div class="row align-items-center text-center">
                                                <div class="col-4 p-r-0">
                                                    <i class="ti-package text-c-green f-24"></i>
                                                </div>
                                                <div class="col-8 p-l-0">
                                                    <h5>{{ $total['barang'] }}</h5>
                                                    <p class="text-muted m-b-0">Barang</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-sm-6 p-b-20 p-t-20 b-r-default">
                                            <div class="row align-items-center text-center">
                                                <div class="col-4 p-r-0">
                                                    <i class="bi bi-truck text-c-red f-24"></i>
                                                </div>
                                                <div class="col-8 p-l-0">
                                                    <h5>{{ $total['supplier'] }}</h5>
                                                    <p class="text-muted m-b-0">Suppliers</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 p-b-20 p-t-20">
                                            <div class="row align-items-center text-center">
                                                <div class="col-4 p-r-0">
                                                    <i class="bi bi-box-arrow-up text-c-blue f-24"></i>
                                                </div>
                                                <div class="col-8 p-l-0">
                                                    <h5>{{ $total['bahan_baku'] }}</h5>
                                                    <p class="text-muted m-b-0">Bahan Baku</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12">
                            <div class="row">
                                <!-- sale card start -->

                                <div class="col-md-6">
                                    <div class="card text-center order-visitor-card">
                                        <div class="card-block">
                                            <h6 class="m-b-0">Total Stok Opname</h6>
                                            <h4 class="m-t-15 m-b-15"><i
                                                    class="fa fa-arrow-down m-r-15 text-c-red"></i>{{ $total['stok_opname'] }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card text-center order-visitor-card">
                                        <div class="card-block">
                                            <h6 class="m-b-0">Total Pemesanan</h6>
                                            <h4 class="m-t-15 m-b-15"><i
                                                    class="fa fa-arrow-up m-r-15 text-c-green"></i>{{ $total['pemesanan'] }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- sale card end -->
                            </div>
                            {{-- <div class="card mat-stat-card">
                                <div class="card-block">
                                    <div class="row align-items-center b-b-default">
                                        <div class="col-sm-6 b-r-default p-b-20 p-t-20">
                                            <div class="row align-items-center text-center">
                                                <div class="col-4 p-r-0">
                                                    <i class="fas fa-share-alt text-c-purple f-24"></i>
                                                </div>
                                                <div class="col-8 p-l-0">
                                                    <h5>1000</h5>
                                                    <p class="text-muted m-b-0">Share</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 p-b-20 p-t-20">
                                            <div class="row align-items-center text-center">
                                                <div class="col-4 p-r-0">
                                                    <i class="fas fa-sitemap text-c-green f-24"></i>
                                                </div>
                                                <div class="col-8 p-l-0">
                                                    <h5>600</h5>
                                                    <p class="text-muted m-b-0">Network</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-sm-6 p-b-20 p-t-20 b-r-default">
                                            <div class="row align-items-center text-center">
                                                <div class="col-4 p-r-0">
                                                    <i class="fas fa-signal text-c-red f-24"></i>
                                                </div>
                                                <div class="col-8 p-l-0">
                                                    <h5>350</h5>
                                                    <p class="text-muted m-b-0">Returns</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 p-b-20 p-t-20">
                                            <div class="row align-items-center text-center">
                                                <div class="col-4 p-r-0">
                                                    <i class="fas fa-wifi text-c-blue f-24"></i>
                                                </div>
                                                <div class="col-8 p-l-0">
                                                    <h5>100%</h5>
                                                    <p class="text-muted m-b-0">Connections</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <!-- Material statustic card end -->
                        <!-- order-visitor start -->


                        <!-- order-visitor end -->

                        <!--  sale analytics start -->
                        <div class="col-xl-6 col-md-12">
                            <div class="card table-card">
                                <div class="card-header">
                                    <h5>Pemesanan Terkahir</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="fa fa fa-wrench open-card-option"></i>
                                            </li>
                                            <li><i class="fa fa-window-maximize full-card"></i>
                                            </li>
                                            <li><i class="fa fa-minus minimize-card"></i></li>
                                            <li><i class="fa fa-refresh reload-card"></i></li>
                                            <li><i class="fa fa-trash close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive">
                                        <table class="table table-hover m-b-0 without-header">
                                            <tbody>
                                                @foreach ($pemesanans as $pemesanan)
                                                    <tr>
                                                        <td>
                                                            <div class="d-inline-block align-middle">
                                                                <div class="d-inline-block">
                                                                    <h6>Tgl Pemesanan:
                                                                        {{ date('d M Y', strtotime($pemesanan->tgl_pesan)) }}
                                                                    </h6>
                                                                    <p class="text-muted m-b-0">Supplier:
                                                                        {{ $pemesanan->supplier->nama_supplier }}</p>
                                                                    <p class="text-muted m-b-0">Pesanan:
                                                                        {{ $pemesanan->bahan_baku->nama_barang }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <h6 class="f-w-700">
                                                                Rp.{{ number_format($pemesanan->total_harga, 0, ',', '.') }}
                                                                ({{ $pemesanan->jumlah_barang }})
                                                                <p class="text-muted m-b-0">
                                                                    {{ $pemesanan->status }}</p>
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12">
                            <div class="card table-card">
                                <div class="card-header">
                                    <h5>Permintaan Barang Terakhir</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="fa fa fa-wrench open-card-option"></i>
                                            </li>
                                            <li><i class="fa fa-window-maximize full-card"></i>
                                            </li>
                                            <li><i class="fa fa-minus minimize-card"></i></li>
                                            <li><i class="fa fa-refresh reload-card"></i></li>
                                            <li><i class="fa fa-trash close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block pb-0 ">
                                    <div class="table-responsive my-0 py-0 ">
                                        <table class="table table-hover without-header">
                                            <tbody>
                                                @foreach ($permintaans as $permintaan)
                                                    <tr>
                                                        <td>
                                                            <div class="d-inline-block align-middle">
                                                                <div class="d-inline-block">
                                                                    <h6>Tgl Dibutuhkan:
                                                                        {{ date('d M Y', strtotime($permintaan->tanggal_dibutuhkan)) }}
                                                                    </h6>
                                                                    <span class="text-muted my-0 py-0 ">Barang:
                                                                        @foreach ($permintaan->permintaan_barang as $minta)
                                                                            <li class="">
                                                                                {{ $minta->barang?->nama_barang }}
                                                                                x {{ $minta->jumlah_barang }}
                                                                            </li>
                                                                        @endforeach
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <h6 class="f-w-700">Rp.
                                                                {{ number_format($permintaan->total_harga, 0, ',', '.') }}
                                                                ({{ $permintaan->total_barang }})
                                                                <p class="text-muted m-b-0">
                                                                    {{ $permintaan->status_permintaan }}</p>
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
            <div id="styleSelector"> </div>
        </div>
    </div>
@endsection
