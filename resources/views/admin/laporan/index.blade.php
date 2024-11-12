<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengguna Bulan Ini</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #000000;
            text-align: center;
            /* padding: 8px; */
        }

        /* tr:nth-child(even) {
            background-color: #dddddd;
        } */

        h4 {
            font-family: arial, sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <table>
            <thead>
                <tr style="background-color: #3399ff;">
                    <th>No.</th>
                    <th>Nama</th>
                    <th>ID Meter</th>
                    <th>Periode</th>
                    <th>Status</th>
                    <th>Jumlah Bayar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align: left">{{ $d->name }}</td>
                    <td style="text-align: left">{{ $d->meter_id }}</td>
                    <td style="text-align: center">{{ $d->bulan . ' - ' . $d->tahun }}</td>
                    <td style="text-align: left">{{ $d->status }}</td>
                    <td style="text-align: right">Rp {{ number_format($d->jumlah_bayar, 0) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>