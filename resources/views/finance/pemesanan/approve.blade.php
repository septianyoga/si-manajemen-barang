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
                                            <td>{{ $pemesanan->bahan_baku?->nama_barang }}</td>
                                            <td>{{ $pemesanan->supplier?->nama_supplier }}</td>
                                            <td>{{ $pemesanan->jumlah_barang }}</td>
                                            <td>Rp. {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                            <td>{{ date('d-m-Y', strtotime($pemesanan->tgl_pesan)) }}</td>
                                            <td>
                                                <div class="label-main">
                                                    @if ($pemesanan->status != 'Menunggu Approve')
                                                        <label class="label label-success"> Di Approve
                                                        </label>
                                                    @else
                                                        <label class="label label-primary"> {{ $pemesanan->status }}
                                                        </label>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if ($pemesanan->status != 'Menunggu Approve')
                                                    <button onclick="confirmApprove({{ $pemesanan->id }})"
                                                        class="btn btn-success btn-disabled disabled"><i
                                                            class="icofont icofont-check-circled"></i>Approved</button>
                                                @else
                                                    <button onclick="confirmApprove({{ $pemesanan->id }})"
                                                        class="btn btn-outline-success"><i
                                                            class="icofont icofont-check-circled"></i>Approve</button>
                                                    <button class="btn btn-outline-danger"
                                                        onclick="showReject({{ $pemesanan->id }})">Tolak</button>
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
        function confirmApprove(id) {
            Swal.fire({
                title: "Yakin ingin approve pesanan ini?",
                text: "Pencatatan Keuangan akan otomatis ditambahkan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Approve!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '/approve_pesanan/' + id + '/approve';
                }
            });
        }
    </script>
    <script>
        function showReject(id) {
            Swal.fire({
                title: "Masukan Pesan Penolakan",
                input: "textarea",
                inputAttributes: {
                    autocapitalize: "off"
                },
                showCancelButton: true,
                confirmButtonText: "Tolak",
                confirmButtonColor: "#d33",
                showLoaderOnConfirm: true,
                preConfirm: async (message) => {
                    if (message == '') {
                        return Swal.showValidationMessage('Pesan Tolak Wajib Diisi!');
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    // Set the values in the hidden form inputs
                    document.querySelector('form#rejectForm input[name="id"]').value = id;
                    document.querySelector('form#rejectForm input[name="pesan"]').value = result.value;

                    // Submit the form
                    document.querySelector('form#rejectForm').submit();
                }
            });
        }
    </script>
    <form id="rejectForm" action="/approve_pesanan/reject" method="POST">
        @csrf
        <input type="hidden" name="id">
        <input type="hidden" name="pesan">
    </form>
@endsection
