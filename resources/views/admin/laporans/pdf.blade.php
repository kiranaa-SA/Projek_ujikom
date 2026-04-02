<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman & Pengembalian</title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            font-size: 12px; 
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 15px; 
        }

        table, th, td { 
            border: 1px solid #000; 
        }

        th, td { 
            padding: 6px; 
            text-align: center; 
        }

        th { 
            background: #f2f2f2; 
        }
    </style>
</head>
<body>

    <h2>Laporan Peminjaman & Pengembalian</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pinjam</th>
                <th>Tenggat Tempo</th>
                <th>Tanggal Kembali</th>
                <th>Judul Buku</th>
                <th>Kondisi Buku</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporans as $laporan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $laporan->tanggal_pinjam ?? '-' }}</td>
                <td>{{ $laporan->tenggat_tempo ?? '-' }}</td>
                <td>{{ $laporan->pengembalian?->tanggal_pengembalian ?? '-' }}</td>
                <td>{{ $laporan->buku?->judul ?? '-' }}</td>
                <td>{{ ucfirst($laporan->pengembalian?->kondisi ?? '-') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Data tidak ditemukan</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>