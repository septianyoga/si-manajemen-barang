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
                        <li class="breadcrumb-item"><a href="/keuangan">{{ $title }}</a>
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
                            <h5>Data Keuangan</h5>
                            <div class="card-header-right d-flex align-items-center ">
                                {{-- <button class="btn btn-primary" id="tambah" data-toggle="modal"
                                    data-target="#exampleModal"><i class="ti-plus text-white "></i> Tambah</button> --}}
                                <ul class="list-unstyled card-option">
                                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between ">
                                <div>
                                    <h6>Total Pemasukan : Rp. {{ number_format($pemasukan, 0, ',', '.') }}</h6>
                                    <h6>Total Pengeluaran : Rp. {{ number_format($pengeluaran, 0, ',', '.') }}</h6>
                                </div>
                                <h6>Total Keuangan : Rp. {{ number_format($uang_saat_ini, 0, ',', '.') }}</h6>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <table class="table table-hover w-100" id="datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Keterangan</th>
                                        <th>Kategori</th>
                                        <th>Biaya</th>
                                        <th>Nama Barang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($keuangans as $keuangan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $keuangan->keterangan }}</td>
                                            <td>{{ $keuangan->kategori }}</td>
                                            <td>Rp. {{ number_format($keuangan->biaya, 0, ',', '.') }}</td>
                                            <td>
                                                @if ($keuangan->kategori == 'Pengeluaran')
                                                    {{ $keuangan->pemesanan->bahan_baku->nama_barang }}
                                                @else
                                                    <ul>
                                                        @foreach ($keuangan->permintaan->permintaan_barang as $barangs)
                                                            <li>
                                                                <i class="bi bi-dot"></i>
                                                                {{ $barangs->barang->nama_barang }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </td>
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
    {{-- modal --}}

    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var tombol = document.getElementById("tambah");
                tombol.click();
            });
        </script>
    @endif
@endsection
