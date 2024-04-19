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
            <th align="left">Harga</th>
            <th align="left">Biaya Penyimpanan</th>
            <th align="left">Stok</th>
            <th align="left">Satuan</th>
            <th align="left">Kategori</th>
        </tr>
        @foreach ($bahan_bakus as $bahan_baku)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $bahan_baku->nama_barang }}</td>
                <td>Rp. {{ number_format($bahan_baku->harga, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($bahan_baku->biaya_penyimpanan, 0, ',', '.') }}</td>
                <td>{{ $bahan_baku->stok }}</td>
                <td>{{ $bahan_baku->satuan }}</td>
                <td>{{ $bahan_baku->kategori }}</td>
            </tr>
        @endforeach
    </table>
    <p>Dicetak oleh {{ Auth::user()->nama }}, {{ date('d-m-Y H:i:s') }}.</p>
</body>

</html>
