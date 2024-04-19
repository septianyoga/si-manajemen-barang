<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak PO</title>
    <style>
        :root {
            font-family: sans-serif;
        }
    </style>
</head>

<body>
    <nav>
        <table>
            <tr>
                <td>
                    <img src="https://raw.githubusercontent.com/septianyoga/si-manajemen-barang/main/public/assets/img/logo.jpg"
                        alt="" width="70">
                </td>
                <td style="width: ">
                    <h3 style="margin: 0; padding: 0;">PT Teknologi Mudah Terhubung</h3>
                    <small style="margin: 0; padding: 0;">Jalan Cenada No AE/55, Cigadung, Subang - Jawa
                        Barat</small><br>
                    <small style="margin: 0; padding: 0;">0899-61-50-000</small>
                </td>
                <td style="width: 230px;">
                    <div style=" float: right">
                        <img src="https://raw.githubusercontent.com/septianyoga/si-manajemen-barang/main/public/assets/img/logo-tap.jpg"
                            alt="" width="110">
                    </div>
                </td>
            </tr>
        </table>
    </nav>
    <hr>
    <p style="font-weight: bold">Purchase Order</p>
    <table>
        <tr>
            <td>Document Number</td>
            <td>:</td>
            <td>PO000{{ $pemesanan->id }}</td>
        </tr>
        <tr>
            <td>Document Date</td>
            <td>:</td>
            <td>{{ date('d M Y', strtotime($pemesanan->tgl_pesan)) }}</td>
        </tr>
        <tr>
            <td>Vendor Name</td>
            <td>:</td>
            <td>{{ $pemesanan->supplier->nama_supplier }}</td>
        </tr>
    </table>

    <table style="width: 100%; margin-top: 10px;" border="1" cellspacing="0" cellpadding="4">
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>QTY</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
        <tr>
            <th>1.</th>
            <th>{{ $pemesanan->bahan_baku->nama_barang }}</th>
            <th>{{ $pemesanan->jumlah_barang }}</th>
            <th>{{ $pemesanan->bahan_baku->harga }}</th>
            <th>{{ $pemesanan->bahan_baku->harga * $pemesanan->jumlah_barang }}</th>
        </tr>
    </table>
    <table border="1" cellspacing="0" cellpadding="4" style="margin-top: 20px; width: 100%;">
        <tr>
            <td>Catatan</td>
        </tr>
        <tr>
            <td style="height: 400px;"></td>
        </tr>
    </table>
</body>

</html>
