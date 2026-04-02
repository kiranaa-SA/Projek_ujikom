@extends('layouts.backend')

@section('title', 'Tambah Pengembalian')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3>Tambah Pengembalian</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('petugas.pengembalians.store') }}" method="POST">
                @csrf

                {{-- Pilih Peminjaman --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Peminjaman</label>
                    <select name="peminjaman_id" id="peminjaman_id"
                        class="form-select select-search" required>
                        <option value="">-- Pilih Peminjaman --</option>
                        @foreach($peminjamans as $p)
                            <option value="{{ $p->id }}"
                                data-user="{{ $p->user->name }}"
                                data-buku="{{ $p->buku->judul }}"
                                data-tanggal="{{ $p->tanggal_pinjam }}"
                                data-tenggat="{{ $p->tenggat_tempo }}"
                                data-status="{{ $p->status }}">
                                {{ $p->user->name }} - {{ $p->buku->judul }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Informasi Otomatis --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Peminjam</label>
                        <input type="text" id="nama_peminjam" class="form-control" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Buku</label>
                        <input type="text" id="nama_buku" class="form-control" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tanggal Pinjam</label>
                        <input type="date" id="tanggal_pinjam" class="form-control" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tenggat Waktu</label>
                        <input type="date" id="tenggat_tempo" class="form-control" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status Buku</label>
                        <input type="text" id="status_buku" class="form-control" readonly>
                    </div>
                </div>

                {{-- Kondisi Buku --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kondisi Buku</label>
                    <select name="kondisi" class="form-select" required>
                        <option value="baik">Baik</option>
                        <option value="rusak">Rusak</option>
                        <option value="hilang">Hilang</option>
                    </select>
                </div>

                {{-- Tanggal Pengembalian --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Tanggal Pengembalian</label>
                    <input type="date" name="tanggal_pengembalian"
                        class="form-control"
                        value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('petugas.pengembalians.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ================= SELECT2 ================= --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select-search').select2({
            placeholder: "-- Pilih Peminjaman --",
            allowClear: true,
            width: '100%'
        });
    });

    const peminjamanSelect = document.getElementById('peminjaman_id');
    const namaPeminjam = document.getElementById('nama_peminjam');
    const namaBuku = document.getElementById('nama_buku');
    const tanggalPinjam = document.getElementById('tanggal_pinjam');
    const tenggatTempo = document.getElementById('tenggat_tempo');
    const statusBuku = document.getElementById('status_buku');

    peminjamanSelect.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];

        if (this.value) {
            namaPeminjam.value = selected.dataset.user;
            namaBuku.value = selected.dataset.buku;
            tanggalPinjam.value = selected.dataset.tanggal;
            tenggatTempo.value = selected.dataset.tenggat;
            statusBuku.value = selected.dataset.status;
        } else {
            namaPeminjam.value = '';
            namaBuku.value = '';
            tanggalPinjam.value = '';
            tenggatTempo.value = '';
            statusBuku.value = '';
        }
    });
</script>
@endsection