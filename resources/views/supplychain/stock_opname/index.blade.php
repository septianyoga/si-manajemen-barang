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
                        <li class="breadcrumb-item"><a href="/stock_opname">{{ $title }}</a>
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
                            <h5>Data Stock Opname</h5>
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
                                        <th>Status</th>
                                        <th>Jumlah</th>
                                        <th>Dibuat pada</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stock_opnames as $stok)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $stok->barang?->nama_barang }}</td>
                                            <td>{{ $stok->status }}</td>
                                            <td>{{ $stok->jumlah }}</td>
                                            <td>{{ date('d-m-Y H:i:s', strtotime($stok->created_at)) }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#edit-{{ $stok->id }}"><i
                                                        class="ti-pencil-alt"></i></button>
                                                <button onclick="handleDelete({{ $stok->id }}, 'stock_opname')"
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Stock Opname</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/stock_opname" method="POST" class="form-material">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group form-default form-static-label">
                            <select name="barang_id" id="barang_id" class="form-control">
                                <option value="" hidden>-- Pilih --</option>
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                @endforeach
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label text-dark">Pilh Barang</label>
                            @error('barang_id')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group form-default form-static-label">
                            <input type="text" name="status" class="form-control" placeholder="Masukan Harga Barang">
                            <span class="form-bar"></span>
                            <label class="float-label">Status</label>
                            @error('status')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group form-default form-static-label mt-4">
                            <input type="number" name="jumlah" class="form-control" placeholder="Masukan Stok Barang">
                            <span class="form-bar"></span>
                            <label class="float-label">Jumlah</label>
                            @error('jumlah')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <small>*Stok Barang akan langsung berukang.</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($stock_opnames as $item)
        <div class="modal fade" id="edit-{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Stock Opname</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/stock_opname/{{ $item->id }}" method="POST" class="form-material">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group form-default form-static-label">
                                <input type="text" name="barang_id" class="form-control"
                                    placeholder="Masukan Harga Barang" value="{{ $item->barang->nama_barang }}" disabled>
                                <span class="form-bar"></span>
                                <label class="float-label text-dark">Pilh Barang</label>
                                @error('barang_id')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group form-default form-static-label">
                                <input type="text" name="status" class="form-control"
                                    placeholder="Masukan Harga Barang" value="{{ $item->status }}">
                                <span class="form-bar"></span>
                                <label class="float-label">Status</label>
                                @error('status')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group form-default form-static-label mt-4">
                                <input type="number" name="jumlah" class="form-control"
                                    placeholder="Masukan Stok Barang" value="{{ $item->jumlah }}">
                                <span class="form-bar"></span>
                                <label class="float-label">Jumlah</label>
                                @error('jumlah')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                            <small>*Stok Barang akan langsung berukang.</small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Ubah</button>
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
