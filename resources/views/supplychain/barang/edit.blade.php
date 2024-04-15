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
                        <li class="breadcrumb-item"><a href="/barang">Barang</a>
                        </li>
                        <li class="breadcrumb-item"><a href="/barang/{{ $barang->id }}">{{ $title }}</a>
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
                                <ul class="list-unstyled card-option">
                                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <form action="/barang/{{ $barang->id }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="card-block table-border-style">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Barang</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama_barang"
                                            placeholder="Masukan Nama Barang" value="{{ $barang->nama_barang }}">
                                        @error('nama_barang')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Harga Barang</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="harga_barang"
                                            placeholder="Masukan Harga Barang" value="{{ $barang->harga_barang }}">
                                        @error('harga_barang')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Stok Barang</label>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" name="stok_barang"
                                            placeholder="Masukan Stok Barang" value="{{ $barang->stok_barang }}" disabled>
                                        @error('stok_barang')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-7">
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#tambahstok">Tambah Stok</button>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#kurangistok">Kurangi Stok</button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-12 col-form-label">Bahan yang dibutuhkan</label>
                                    <div class="col-lg-4 col-12">
                                        @foreach ($bahan_bakus as $bahan)
                                            <div
                                                class="form-group d-flex align-items-center justify-content-between form-check">
                                                <div>
                                                    <input type="checkbox" class="form-check-input" name="bahan[]"
                                                        value="{{ $bahan->id }}" id="{{ $bahan->id }}"
                                                        {{ $barang->barang_bahan_baku->contains('bahan_baku_id', $bahan->id) ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="{{ $bahan->id }}">{{ $bahan->nama_barang }} (tersisa:
                                                        {{ $bahan->stok }})</label>
                                                </div>
                                                <div class="d-flex ml-3 w-25 align-items-center">
                                                    <input type="number" class="form-control" name="jumlah[]"
                                                        max="{{ $bahan->stok + ($barang->barang_bahan_baku->contains('bahan_baku_id', $bahan->id) ? $barang->barang_bahan_baku->where('bahan_baku_id', $bahan->id)->first()->jumlah : '0') }}"
                                                        value="{{ $barang->barang_bahan_baku->contains('bahan_baku_id', $bahan->id) ? $barang->barang_bahan_baku->where('bahan_baku_id', $bahan->id)->first()->jumlah : '0' }}">
                                                    <label>pcs</label>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status Barang</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="status_barang"
                                            placeholder="Masukan Status Barang" value="{{ $barang->status_barang }}">
                                        @error('status_barang')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between ">
                                <a href="/barang" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
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

    <div class="modal fade" id="tambahstok" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Stok Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/barang/tambahi/{{ $barang->id }}" method="POST" class="form-material">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group form-default form-static-label">
                            <input type="number" name="jumlah" class="form-control"
                                placeholder="Masukan Stok Penambahan" required>
                            <span class="form-bar"></span>
                            <label class="float-label">Jumlah Tambah Barang</label>
                        </div>
                        <small>*Akan langsung mengurangi stok bahan</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kurangistok" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kurangi Stok Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/barang/kurangi/{{ $barang->id }}" method="POST" class="form-material">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group form-default form-static-label">
                            <input type="number" name="jumlah" class="form-control"
                                placeholder="Masukan Stok Pengurangan">
                            <span class="form-bar"></span>
                            <label class="float-label">Jumlah Pengurangan Barang</label>
                        </div>
                        <small>*Akan langsung mengembalikan stok bahan</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Kurangi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
