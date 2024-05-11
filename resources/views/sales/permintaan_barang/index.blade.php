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
                        <li class="breadcrumb-item"><a href="/permintaan_barang">{{ $title }}</a>
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
                            <h5>Data Permintaan Barang</h5>
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
                                        <th>Tanggal Dibutuhkan</th>
                                        <th>Total Barang</th>
                                        <th>Total Harga</th>
                                        <th>Barang</th>
                                        <th>Status Permintaan</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permintaans as $permintaan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d-m-Y', strtotime($permintaan->tanggal_dibutuhkan)) }}</td>
                                            <td>{{ $permintaan->total_barang }}</td>
                                            <td>Rp. {{ number_format($permintaan->total_harga, 0, ',', '.') }}</td>
                                            <td>
                                                <ul>
                                                    @foreach ($permintaan->permintaan_barang as $permintaans)
                                                        <li class=""><i
                                                                class="bi bi-dot"></i>{{ $permintaans->barang?->nama_barang }}
                                                            x {{ $permintaans->jumlah_barang }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <div class="label-main">
                                                    @if ($permintaan->status_permintaan == 'Menunggu Approve')
                                                        <label class="label label-primary">
                                                            {{ $permintaan->status_permintaan }}
                                                        </label>
                                                    @elseif($permintaan->status_permintaan == 'Dikonfirmasi')
                                                        <label class="label label-info">
                                                            {{ $permintaan->status_permintaan }}
                                                        </label>
                                                    @else
                                                        <label class="label label-success">
                                                            {{ $permintaan->status_permintaan }}
                                                        </label>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if ($permintaan->status_permintaan == 'Dikonfirmasi')
                                                    <button onclick="handleConfirm({{ $permintaan->id }})"
                                                        class="btn btn-outline-info"><i
                                                            class="icofont icofont-check-circled"></i>Selesaikan</button>
                                                @else
                                                    <button class="btn btn-outline-success btn-disabled disabled"><i
                                                            class="icofont icofont-check-circled"></i>Selesai</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Permintaan Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/permintaan_barang" method="POST" class="form-material">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group form-default form-static-label">
                            <input type="date" name="tanggal_dibutuhkan" class="form-control"
                                placeholder="Masukan tanggal dibutuhkan" value="{{ date('Y-m-d') }}" required>
                            <span class="form-bar"></span>
                            <label class="float-label text-dark">Tanggal Dibutuhkan</label>
                            @error('jumlah_barang')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group form-default form-static-label">
                            <label class="text-dark">Barang</label>
                            <div id="inputs-container">
                                @foreach ($barangs as $barang)
                                    <div
                                        class="form-group d-flex align-items-center justify-content-between form-check mb-0 mt-0 pt-0 pb-0">
                                        <div>
                                            <input type="checkbox" class="form-check-input" name="barang[]"
                                                value="{{ $barang->id }}" id="{{ $barang->id }}">
                                            <label class="form-check-label"
                                                for="{{ $barang->id }}">{{ $barang->nama_barang }} (tersisa:
                                                {{ $barang->stok_barang }})</label>
                                        </div>
                                        <div class="d-flex ml-3 w-25 align-items-center ">
                                            <input type="number" class="form-control" name="jumlah_barang[]" value="0"
                                                max="{{ $barang->stok_barang }}">
                                            <label>pcs</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('total_harga')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Buat Permintaan Barang</button>
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
                title: "Yakin ingin menyelesaikan permintaan?",
                text: "Anda tidak bisa membatalkannya!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Konfirmasi!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '/permintaan_barang/' + id;
                }
            });
        }
    </script>

    <script type="text/javascript" src="{{ asset('template/backend/assets/js/jquery/jquery.min.js') }} "></script>

    <script>
        // $(document).ready(function() {
        //     $('#add').on('click', function() {
        //         var newInput = `

    //         `;
        //         $('#inputs-container').append(newInput);
        //     });

        //     // Menggunakan event delegation untuk tombol hapus karena elemen baru
        //     $('#inputs-container').on('click', '.remove-input', function() {
        //         $(this).parent().remove();
        //     });
        // });
    </script>
@endsection
