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
                                        <th>Harga</th>
                                        <th>Biaya Penyimpanan</th>
                                        <th>Stok</th>
                                        <th>Satuan</th>
                                        <th>Kategori</th>
                                        <th class="text-center">Opsi</th>
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
                                            <td class="text-center">
                                                <a href="/eoq/{{ $bahan_baku->id }}"
                                                    class="btn waves-effect waves-light btn-inverse"><i
                                                        class="icofont icofont-exchange"></i>Hitung EOQ</a>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Bahan Baku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/eoq" method="POST" class="form-material">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group form-default form-static-label">
                            <input type="text" name="nama_barang" class="form-control"
                                placeholder="Masukan Nama Bahan Baku" value="{{ old('nama_barang') }}">
                            <span class="form-bar"></span>
                            <label class="float-label text-dark">Nama Bahan Baku</label>
                            @error('nama_barang')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group form-default form-static-label">
                            <select name="satuan" id="satuan" class="form-control">
                                <option value="" hidden>-- Pilih --</option>
                                <option value="pcs">pcs</option>
                                <option value="unit">unit</option>
                                <option value="gram">gram</option>
                                <option value="kilogram">kilogram</option>
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label text-dark">Satuan</label>
                            @error('satuan')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group form-default form-static-label">
                            <input type="number" name="harga" class="form-control" placeholder="Masukan Harga Barang"
                                value="{{ old('harga') }}">
                            <span class="form-bar"></span>
                            <label class="float-label text-dark">Harga Barang</label>
                            @error('harga')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group form-default form-static-label">
                            <input type="number" name="biaya_penyimpanan" class="form-control"
                                placeholder="Masukan Biaya Penyimpanan" value="{{ old('biaya_penyimpanan') }}">
                            <span class="form-bar"></span>
                            <label class="float-label text-dark">Biaya Penyimpanan</label>
                            @error('biaya_penyimpanan')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group form-default form-static-label">
                            <input type="number" name="stok" class="form-control" placeholder="Masukan Stok Awal"
                                value="{{ old('stok') }}">
                            <span class="form-bar"></span>
                            <label class="float-label text-dark">Stok Awal Barang</label>
                            @error('stok')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group form-default form-static-label">
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="" hidden>-- Pilih --</option>
                                <option value="Product">Product</option>
                                <option value="Packaging">Packaging</option>
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label text-dark">Kategori</label>
                            @error('kategori')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var tombol = document.getElementById("tambah");
                tombol.click();
            });
        </script>
    @endif
@endsection
