<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Jadwal Marbot / Kebersihan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f0f0f0;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .footer {
            margin-top: 30px;
            font-size: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Jadwal Marbot / Kebersihan</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Petugas</th>
                <th>Shift</th>
                <th>Tugas</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwal as $m)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($m->tanggal_piket)->format('d/m/Y') }}</td>
                    <td>{{ $m->nama_petugas }}</td>
                    <td>{{ $m->shift }}</td>
                    <td>{{ $m->tugas }}</td>
                    <td>{{ $m->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">Dicetak pada: {{ now()->format('d/m/Y H:i') }}</div>
</body>

</html>