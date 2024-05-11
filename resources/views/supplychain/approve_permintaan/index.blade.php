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
                                                @if ($permintaan->status_permintaan == 'Menunggu Approve')
                                                    <button onclick="handleConfirm({{ $permintaan->id }})"
                                                        class="btn btn-outline-success"><i
                                                            class="icofont icofont-check-circled"></i>Approve</button>
                                                @else
                                                    <button class="btn btn-outline-success btn-disabled disabled"><i
                                                            class="icofont icofont-check-circled"></i>Approve</button>
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

    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script>
        function handleConfirm(id) {
            Swal.fire({
                title: "Yakin ingin Approve Permintaan Barang ini?",
                text: "Stok barang akan berkurang dan pencatatan keuangan akan bertambah setelah approve!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Konfirmasi!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '/approve_permintaan/' + id;
                }
            });
        }
    </script>
@endsection
