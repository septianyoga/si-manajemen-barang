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
            <th align="left">Nama Barang</th>
            <th align="left">Harga Barang</th>
            <th align="left">Stok Barang</th>
            <th align="left">Status Barang</th>
            <th align="left">Bahan</th>
        </tr>
        @foreach ($barangs as $barang)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->harga_barang }}</td>
                <td>{{ $barang->stok_barang }}</td>
                <td>{{ $barang->status_barang }}</td>
                <td>
                    <ul>
                        @foreach ($barang->barang_bahan_baku as $bahan)
                            <li class=""><i class="bi bi-dot"></i>{{ $bahan->bahan_baku?->nama_barang }}
                                x {{ $bahan->jumlah }} {{ $bahan->bahan_baku?->satuan }}
                            </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>
    <p>Dicetak oleh {{ Auth::user()->nama }}, {{ date('d-m-Y H:i:s') }}.</p>
</body>

</html>
