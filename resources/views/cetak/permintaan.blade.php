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
            <th align="left">Tanggal Dibutuhkan</th>
            <th align="left">Total Barang</th>
            <th align="left">Total Harga</th>
            <th align="left">Barang</th>
            <th align="left">Status Permintaan</th>
        </tr>
        @foreach ($permintaans as $permintaan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ date('d-m-Y', strtotime($permintaan->tanggal_dibutuhkan)) }}</td>
                <td>{{ $permintaan->total_barang }}</td>
                <td>Rp. {{ number_format($permintaan->total_harga, 0, ',', '.') }}</td>
                <td>
                    <ul>
                        @foreach ($permintaan->permintaan_barang as $permintaans)
                            <li>{{ $permintaans->barang->nama_barang }}
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
            </tr>
        @endforeach
    </table>
    <p>Dicetak oleh {{ Auth::user()->nama }}, {{ date('d-m-Y H:i:s') }}.</p>
</body>

</html>
