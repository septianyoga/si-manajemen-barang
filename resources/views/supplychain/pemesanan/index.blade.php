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
                        <li class="breadcrumb-item"><a href="/pemesanan">{{ $title }}</a>
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
                            <h5>Data Pemesanan</h5>
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
                                        <th>Nama Bahan Baku</th>
                                        <th>Nama Supplier</th>
                                        <th>Jumlah Barang</th>
                                        <th>Total Harga Pemesanan</th>
                                        <th>Tanggal Pemesanan</th>
                                        <th>Status</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pemesanans as $pemesanan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pemesanan->bahan_baku->nama_barang }}</td>
                                            <td>{{ $pemesanan->supplier->nama_supplier }}</td>
                                            <td>{{ $pemesanan->jumlah_barang }}</td>
                                            <td>Rp. {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                            <td>{{ date('d-m-Y', strtotime($pemesanan->tgl_pesan)) }}</td>
                                            <td>
                                                <div class="label-main">
                                                    @if ($pemesanan->status == 'Menunggu Approve')
                                                        <label class="label label-primary"> {{ $pemesanan->status }}
                                                        </label>
                                                    @elseif($pemesanan->status == 'Menunggu Konfirmasi')
                                                        <label class="label label-warning"> {{ $pemesanan->status }}
                                                        </label>
                                                    @elseif($pemesanan->status == 'Dalam Proses')
                                                        <label class="label label-info"> {{ $pemesanan->status }}
                                                        </label>
                                                    @else
                                                        <label class="label label-success"> {{ $pemesanan->status }}
                                                        </label>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if ($pemesanan->status == 'Menunggu Konfirmasi')
                                                    <button onclick="handleConfirm({{ $pemesanan->id }})"
                                                        class="btn btn-sm btn-outline-warning"><i
                                                            class="icofont icofont-check-circled"></i>Konfirmasi</button>
                                                @elseif($pemesanan->status == 'Dalam Proses')
                                                    <button onclick="handleDiterima({{ $pemesanan->id }})"
                                                        class="btn btn-sm btn-outline-info"><i
                                                            class="icofont icofont-check-circled"></i>Pesanan
                                                        Diterima</button>
                                                @elseif($pemesanan->status == 'Selesai')
                                                    <button class="btn btn-sm btn-outline-success btn-disabled disabled"><i
                                                            class="icofont icofont-check-circled"></i>Selesai</button>
                                                @else
                                                    <button class="btn btn-sm btn-outline-warning btn-disabled disabled"><i
                                                            class="icofont icofont-check-circled"></i>Konfirmasi</button>
                                                @endif
                                                @if ($pemesanan->status != 'Menunggu Approve')
                                                    <a href="/cetak_po/{{ $pemesanan->id }}"
                                                        class="btn btn-sm btn-primary">Cetak PO</a>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pemesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/pemesanan" method="POST" class="form-material">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group form-default form-static-label">
                            <select name="bahan_baku_id" id="bahan_baku_id" class="form-control">
                                <option value="" hidden>-- Pilih --</option>
                                @foreach ($bahan_bakus as $bahan_baku)
                                    <option value="{{ $bahan_baku->id }}">{{ $bahan_baku->nama_barang }}</option>
                                @endforeach
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label text-dark">Bahan Baku</label>
                            @error('bahan_baku_id')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group form-default form-static-label">
                            <input type="number" name="jumlah_barang" class="form-control"
                                placeholder="Masukan Jumlah Barang" value="{{ old('jumlah_barang') }}">
                            <span class="form-bar"></span>
                            <label class="float-label text-dark">Jumlah Barang</label>
                            @error('jumlah_barang')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group form-default form-static-label">
                            <input type="number" name="total_harga" class="form-control"
                                placeholder="Masukan Biaya Pemesanan" value="{{ old('total_harga') }}">
                            <span class="form-bar"></span>
                            <label class="float-label text-dark">Biaya Pemesanan</label>
                            @error('total_harga')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group form-default form-static-label">
                            <select name="supplier_id" id="supplier_id" class="form-control">
                                <option value="" hidden>-- Pilih --</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                                @endforeach
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label text-dark">Supplier</label>
                            @error('supplier_id')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group form-default form-static-label">
                            <input type="date" name="tgl_pesan" class="form-control"
                                placeholder="Masukan Biaya Pemesanan"
                                value="{{ old('tgl_pesan') ? old('tgl_pesan') : date('Y-m-d') }}">
                            <span class="form-bar"></span>
                            <label class="float-label text-dark">Tanggal Pemesanan</label>
                            @error('tgl_pesan')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Buat Pemesanan</button>
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
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script>
        function handleConfirm(id) {
            Swal.fire({
                title: "Yakin ingin konfirmasi pesanan kepada Supplier?",
                text: "Konfirmasi akan dikirim otomatis melalui whatsapp!",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Konfirmasi!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '/pemesanan/konfirmasi/' + id;
                }
            });
        }

        function handleDiterima(id) {
            Swal.fire({
                title: "Yakin ingin menyelesaikan pemesanan?",
                text: "Pesanan diselesaikan artinya pesanan sudah anda terima dan akan menambahkan stok barang!",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Selesaikan!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '/pemesanan/selesai/' + id;
                }
            });
        }
    </script>
@endsection
