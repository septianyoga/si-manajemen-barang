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
                                <button class="btn btn-primary" id="tambah" data-toggle="modal"
                                    data-target="#exampleModal"><i class="ti-plus text-white "></i> Tambah</button>
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
                                        <th>Nama Barang</th>
                                        <th>Harga Barang</th>
                                        <th>Stok Barang</th>
                                        <th>Status Barang</th>
                                        <th>Kategori Barang</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangs as $barang)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $barang->nama_barang }}</td>
                                            <td>{{ $barang->harga_barang }}</td>
                                            <td>{{ $barang->stok_barang }}</td>
                                            <td>{{ $barang->status_barang }}</td>
                                            <td>{{ $barang->kategori->nama_kategori }}</td>
                                            <td class="text-center">
                                                <a href="/barang/{{ $barang->id }}" class="btn btn-info btn-sm"><i
                                                        class="ti-pencil-alt"></i></a>
                                                <button onclick="handleDelete({{ $barang->id }}, 'barang')"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="ti-trash"></i>
                                                </button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/barang" method="POST" class="form-material">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group form-default form-static-label">
                            <input type="text" name="nama_barang" class="form-control" placeholder="Masukan Nama Barang">
                            <span class="form-bar"></span>
                            <label class="float-label">Nama Barang</label>
                            @error('nama_barang')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group form-default form-static-label">
                            <input type="number" name="harga_barang" class="form-control"
                                placeholder="Masukan Harga Barang">
                            <span class="form-bar"></span>
                            <label class="float-label">Harga Barang</label>
                            @error('harga_barang')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group form-default form-static-label">
                            <input type="number" name="stok_barang" class="form-control" placeholder="Masukan Stok Barang">
                            <span class="form-bar"></span>
                            <label class="float-label">Stok Awal Barang</label>
                            @error('stok_barang')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group form-default form-static-label">
                            <input type="text" name="status_barang" class="form-control"
                                placeholder="Masukan Status Barang">
                            <span class="form-bar"></span>
                            <label class="float-label">Status Barang</label>
                            @error('status_barang')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group form-default form-static-label">
                            <select name="kategori_id" id="kategori_id" class="form-control">
                                <option value="" hidden>--Pilih--</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label">Kategori Barang</label>
                            @error('kategori_id')
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
