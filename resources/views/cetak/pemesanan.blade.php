<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <style>
        :root {
            font-family: sans-serif;
        }
    </style>
</head>

<body>
    <h3 align="center">{{ $title }}</h3>
    <table style="width: 100%; margin-top: 10px;" border="1" cellspacing="0" cellpadding="6">
        <tr>
            <th align="left">No</th>
            <th align="left">Nama Bahan Baku</th>
            <th align="left">Nama Supplier</th>
            <th align="left">Jumlah Barang</th>
            <th align="left">Total Harga Pemesanan</th>
            <th align="left">Tanggal Pemesanan</th>
            <th align="left">Status</th>
        </tr>
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
            </tr>
        @endforeach
    </table>
    <p>Dicetak oleh {{ Auth::user()->nama }}, {{ date('d-m-Y H:i:s') }}.</p>
</body>

</html>
