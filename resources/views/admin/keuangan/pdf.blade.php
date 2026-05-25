<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan</title>
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

        .text-right {
            text-align: right;
        }

        .summary {
            margin-bottom: 20px;
        }

        .summary div {
            margin-bottom: 4px;
        }
    </style>
</head>

<body>
    <h2>Laporan Keuangan Masjid</h2>
    <p>Periode: {{ now()->format('d M Y') }}</p>

    <div class="summary">
        <div><strong>Total Pemasukan:</strong> Rp {{ number_format($totalIncome, 0, ',', '.') }}</div>
        <div><strong>Total Pengeluaran:</strong> Rp {{ number_format($totalExpense, 0, ',', '.') }}</div>
        <div><strong>Saldo Akhir:</strong> Rp {{ number_format($balance, 0, ',', '.') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Kategori</th>
                <th>Nominal</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($trx->date)->format('d/m/Y') }}</td>
                    <td>{{ $trx->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}</td>
                    <td>{{ $trx->category }}</td>
                    <td class="text-right">Rp {{ number_format($trx->amount, 0, ',', '.') }}</td>
                    <td>{{ $trx->description ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
