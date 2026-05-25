<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Jadwal Sholat Jumat</title>
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
    <h2>Jadwal Sholat Jumat</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Khatib</th>
                <th>Imam</th>
                <th>Bilal</th>
                <th>Muadzin</th>
                <th>Tema Khutbah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwal as $j)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($j->tanggal_jumat)->format('d/m/Y') }}</td>
                    <td>{{ $j->khatib }}</td>
                    <td>{{ $j->imam }}</td>
                    <td>{{ $j->bilal ?? '-' }}</td>
                    <td>{{ $j->muadzin ?? '-' }}</td>
                    <td>{{ $j->tema_khutbah ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">Dicetak pada: {{ now()->format('d/m/Y H:i') }}</div>
</body>

</html>