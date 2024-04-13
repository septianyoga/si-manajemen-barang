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
                        <li class="breadcrumb-item"><a href="/bahan_baku">Bahan Baku</a>
                        </li>
                        <li class="breadcrumb-item"><a href="/bahan_baku/{{ $bahan_baku->id }}">{{ $title }}</a>
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
                            <h5>Data Bahan Baku</h5>
                            <div class="card-header-right d-flex align-items-center ">
                                <ul class="list-unstyled card-option">
                                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <form action="/bahan_baku/{{ $bahan_baku->id }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="card-block table-border-style">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Bahan Baku</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama_barang"
                                            placeholder="Masukan Nama Bahan Baku" value="{{ $bahan_baku->nama_barang }}">
                                        @error('nama_barang')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Satuan</label>
                                    <div class="col-sm-10">
                                        <select name="satuan" id="satuan" class="form-control">
                                            <option value="" hidden>-- Pilih --</option>
                                            <option value="pcs" {{ $bahan_baku->satuan == 'pcs' ? 'selected' : '' }}>pcs
                                            </option>
                                            <option value="unit" {{ $bahan_baku->satuan == 'unit' ? 'selected' : '' }}>
                                                unit
                                            </option>
                                            <option value="gram" {{ $bahan_baku->satuan == 'gram' ? 'selected' : '' }}>
                                                gram
                                            </option>
                                            <option value="kilogram"
                                                {{ $bahan_baku->satuan == 'kilogram' ? 'selected' : '' }}>kilogram</option>
                                        </select>
                                        @error('satuan')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Harga</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="harga"
                                            placeholder="Masukan Harga" value="{{ $bahan_baku->harga }}">
                                        @error('harga')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Biaya Penyimpanan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="biaya_penyimpanan"
                                            placeholder="Masukan Biaya Penyimpanan"
                                            value="{{ $bahan_baku->biaya_penyimpanan }}">
                                        @error('biaya_penyimpanan')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Stok</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="stok" placeholder="Masukan Stok"
                                            value="{{ $bahan_baku->stok }}">
                                        @error('stok')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="col-sm-10">
                                        <select name="kategori" id="kategori" class="form-control">
                                            <option value="" hidden>-- Pilih --</option>
                                            <option value="Product"
                                                {{ $bahan_baku->kategori == 'Product' ? 'selected' : '' }}>Product
                                            </option>
                                            <option value="Packaging"
                                                {{ $bahan_baku->kategori == 'Packaging' ? 'selected' : '' }}>
                                                Packaging
                                            </option>
                                        </select>
                                        @error('kategori')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between ">
                                <a href="/bahan_baku" class="btn btn-secondary">Kembali</a>
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
@endsection
