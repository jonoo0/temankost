<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan</title>

    {{-- <link rel="stylesheet" href="{{ asset('/AdminLTE-2/bower_components/bootstrap/dist/css/bootstrap.min.css') }}"> --}}
</head>
<style>
    .custom-font {
        font-weight: bold;
    }


    table.blueTable {
        border: 1px solid #000000;
        background-color: #ffffff;
        width: 100%;
        text-align: left;
        border-collapse: collapse;
    }

    table.blueTable td,
    table.blueTable th {
        border: 1px solid #020202;
        padding: 3px 2px;
        text-align: center
    }

    table thead tr th {
        font-size: 10px;
        /* font-weight: 100; */
        font-weight: normal;
        font-family: Arial, Helvetica, sans-serif;
    }

    table tbody tr td {
        font-size: 10px;
        /* font-weight: 100; */
        font-weight: normal;
        font-family: Arial, Helvetica, sans-serif;
    }
    table tfoot tr td {
        font-size: 10px;
        /* font-weight: 100; */
        font-weight: normal;
        font-family: Arial, Helvetica, sans-serif;
    }

    table tr th {
        padding: 0px;
    }

    .kop {
        font-size: 8px;
        text-align: right;
        /* font-weight: 100; */
        font-weight: normal;
        font-family: Arial, Helvetica, sans-serif;
    }
</style>

<body>

    <table  style="width: 100%">
        <tr>
            <th rowspan="5">
                <img src="{{ realpath('dist/img/logo1.jpg') }}" style="height: 90px; margin-left:-25px;">
            </th>
        </tr>
        <tr>
            <th class="kop">JL Pantai Gesing KM 6 Warak RT 08/ RW 02</th>
        </tr>
        <tr>
            <th class="kop">Girisekar Panggang Gunungkidul</th>
        </tr>
            <th class="kop">0892182192</th>
        </tr>
        <tr>
            <th class="kop">rumaysho@gmail.com</th>
        </tr>
    </table>
    <br><br>
    <table style="width: 100%">
        <tr>
            @if ($to != null)
            <th style=" font-family: Arial, Helvetica, sans-serif">
                Daftar Penjualan {{ Request::is('penjualan/cetak-pdf') ? tgl($from). ' - ' .tgl($to) : '' }}
            </th>
            @else
            <th style=" font-family: Arial, Helvetica, sans-serif">
                Daftar Penjualan {{ Request::is('penjualan/cetak-pdf') ? 'Per Tanggal '.tgl($from): '' }}
            </th>
            @endif
        </tr>
    </table>
    <br>
    <table class="blueTable">
        <thead>
            <tr style="background-color:rgb(119, 10, 10); color:#ffffff;">
                <th width="5%">No</th>
                <th>Kode transaksi</th>
                <th>Nama Barang</th>
                <th>Tanggal</th>
                <th>User</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Harga Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $x = 1;
                $sum = 0;
                $sb = 0;
                $harga = 0;
            @endphp

            @foreach ($data as $dt)
                <tr>

                    <td>{{ $x++ }}</td>
                    <td>{{ $dt->penjualan->kode_transaksi ?? '' }}</td>
                    <td style="text-align: left">{{ $dt->barang->nama_barang ?? '' }}</td>
                    <td>{{ tgl($dt->penjualan->tanggal ?? '')  }}</td>
                    <td>{{ucfirst($dt->name) ?? ''}}</td>
                    <td>{{ $dt->jumlah }}</td>
                    <td>@currency($dt->barang->harga)</td>
                    <td>@currency($dt->jumlah*$dt->barang->harga)</td>
                    @php
                     $total=   $sum += $dt->jumlah*$dt->barang->harga;
                     $sub =   $sb += $dt->jumlah;
                     $harga=   $harga += $dt->barang->harga ?? 0;
                    @endphp
                </tr>
            @endforeach
        </tbody>
        @if ($data->count() > 0)
        <tfoot>
            <tr>
                <td style="text-align: right" colspan="5">Total</td>
                <td>{{$sub}}</td>
                <td>@currency($harga)</td>
                <td>@currency($total)</td>
            </tr>
        </tfoot>
        @endif
    </table>
</body>

</html>
