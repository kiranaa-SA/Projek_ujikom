<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Perpustakaan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 6px; text-align: center; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Laporan Perpustakaan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pinjam</th>
                <th>Buku</th>
                <th>Tanggal Pengembalian</th>
                <th>Kondisi Buku</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporans as $laporan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $laporan->tanggal_pinjam ?? '-' }}</td>
                <td>{{ $laporan->buku?->judul ?? '-' }}</td>
                <td>{{ $laporan->pengembalian?->tanggal_kembali ?? '-' }}</td>
                <td>{{ ucfirst($laporan->pengembalian?->kondisi ?? '-') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Data tidak ditemukan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
