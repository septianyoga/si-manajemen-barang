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
            <th align="left">Status</th>
            <th align="left">Jumlah</th>
            <th align="left">Dibuat pada</th>
        </tr>
        @foreach ($stock_opnames as $stok)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $stok->barang->nama_barang }}</td>
                <td>{{ $stok->status }}</td>
                <td>{{ $stok->jumlah }}</td>
                <td>{{ date('d-m-Y H:i:s', strtotime($stok->created_at)) }}</td>
            </tr>
        @endforeach
    </table>
    <p>Dicetak oleh {{ Auth::user()->nama }}, {{ date('d-m-Y H:i:s') }}.</p>
</body>

</html>
