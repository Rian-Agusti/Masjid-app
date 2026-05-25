<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Aset Masjid</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f3f4f6;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <h2>Laporan Aset Masjid</h2>
    <p>Tanggal Cetak: {{ now()->format('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asets as $index => $aset)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $aset->nama }}</td>
                    <td>{{ $aset->kategori ?: '-' }}</td>
                    <td>{{ $aset->status }}</td>
                    <td>{{ $aset->deskripsi ?: '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
