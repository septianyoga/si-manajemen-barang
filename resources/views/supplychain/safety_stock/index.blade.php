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
                        <li class="breadcrumb-item"><a href="/eoq">{{ $title }}</a>
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
                            <table class="table table-hover w-100" id="datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Bahan Baku</th>
                                        <th>Stok</th>
                                        <th>Pemakaian Barang</th>
                                        <th>Lead Time</th>
                                        <th>Safety Stock</th>
                                        <th>ROP</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bahan_bakus as $bahan_baku)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $bahan_baku->nama_barang }}</td>
                                            <td>{{ $bahan_baku->stok }}</td>
                                            <td>
                                                <ul>
                                                    @foreach ($bahan_baku->barang_bahan_baku as $barang_bahan)
                                                        <li>
                                                            <i class="bi bi-dot"></i>
                                                            <b
                                                                class="font-weight-bold ">{{ $barang_bahan->barang->nama_barang }}</b>
                                                        </li>
                                                        <li class="ml-3">
                                                            History Permintaan:
                                                            <ul>
                                                                @foreach ($barang_bahan->barang->permintaan_barang as $minta)
                                                                    @if ($minta->permintaan)
                                                                        <li>
                                                                            <i class="bi bi-dot"></i>
                                                                            Tgl
                                                                            {{ date('d-m-Y', strtotime($minta->permintaan->tanggal_dibutuhkan)) }}
                                                                            ({{ $minta->jumlah_barang }})
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ $bahan_baku->lead_time }}</td>
                                            <td>{{ $bahan_baku->safety_stock }}</td>
                                            <td>{{ $bahan_baku->rop }}</td>
                                            <td class="text-center">
                                                @if (count($bahan_baku->barang_bahan_baku) > 0)
                                                    <button class="btn waves-effect waves-light btn-inverse"
                                                        data-toggle="modal" data-target="#hitung-{{ $bahan_baku->id }}"><i
                                                            class="icofont icofont-exchange"></i>Hitung
                                                        {{ $bahan_baku->safety_stock ? 'Ulang' : 'Safety Stock' }}</button>
                                                    @if (!$bahan_baku->rop && $bahan_baku->safety_stock != null)
                                                        <a href="/safety_stock/rop/{{ $bahan_baku->id }}"
                                                            class="btn waves-effect waves-light btn-inverse btn-outline-inverse"><i
                                                                class="icofont icofont-exchange"></i>Hitung ROP</a>
                                                    @elseif($bahan_baku->rop && $bahan_baku->safety_stock != null)
                                                        <a href="/safety_stock/rop/{{ $bahan_baku->id }}"
                                                            class="btn waves-effect waves-light btn-inverse btn-outline-inverse"><i
                                                                class="icofont icofont-exchange"></i>Hitung Ulang
                                                            ROP</a>
                                                    @endif
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
    <!-- Modal -->
    @foreach ($bahan_bakus as $item)
        <div class="modal fade" id="hitung-{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hitung Safety Stock dari {{ $item->nama_barang }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/safety_stock/hitung/{{ $item->id }}" method="POST" class="form-material">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group form-default form-static-label">
                                <input type="text" name="lead_time" class="form-control" placeholder="Masukan Lead Time"
                                    required>
                                <span class="form-bar"></span>
                                <label class="float-label text-dark">Lead Time</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Hitung</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var tombol = document.getElementById("tambah");
                tombol.click();
            });
        </script>
    @endif
@endsection
