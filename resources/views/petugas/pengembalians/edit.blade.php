@extends('layouts.backend')
@section('title','Edit Pengembalian')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Edit Pengembalian</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('petugas.pengembalians.update', $pengembalian->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Kode Pengembalian --}}
                <div class="mb-3">
                    <label for="kode_pengembalian">Kode Pengembalian</label>
                    <input type="text" name="kode_pengembalian"
                           class="form-control @error('kode_pengembalian') is-invalid @enderror"
                           value="{{ old('kode_pengembalian',$pengembalian->kode_pengembalian) }}" required>
                    @error('kode_pengembalian')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kode Peminjaman --}}
                <div class="mb-3">
                    <label for="kode_peminjaman">Kode Peminjaman</label>
                    <input type="text" name="kode_peminjaman" id="kode_peminjaman"
                           class="form-control @error('kode_peminjaman') is-invalid @enderror"
                           value="{{ old('kode_peminjaman',$pengembalian->peminjaman->kode_peminjaman) }}" required>
                    @error('kode_peminjaman')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Preview --}}
                <div id="preview-info" class="border p-3 mb-3 bg-light rounded" style="display:none;">
                    <p><strong>Peminjam:</strong> <span id="preview-user"></span></p>
                    <p><strong>Buku:</strong> <span id="preview-buku"></span></p>
                    <p><strong>Tanggal Pinjam:</strong> <span id="preview-pinjam"></span></p>
                    <p><strong>Tenggat:</strong> <span id="preview-tempo"></span></p>
                    <p><strong>Status:</strong> <span id="preview-status"></span></p>
                </div>

                {{-- Tanggal Pengembalian --}}
                <div class="mb-3">
                    <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                    <input type="date" name="tanggal_pengembalian"
                           class="form-control"
                           value="{{ old('tanggal_pengembalian',$pengembalian->tanggal_pengembalian) }}" required>
                </div>

                {{-- Kondisi --}}
                <div class="mb-3">
                    <label for="kondisi">Kondisi Buku</label>
                    <select name="kondisi" class="form-select" required>
                        <option value="baik" {{ $pengembalian->kondisi=='baik' ? 'selected':'' }}>Baik</option>
                        <option value="rusak" {{ $pengembalian->kondisi=='rusak' ? 'selected':'' }}>Rusak</option>
                        <option value="hilang" {{ $pengembalian->kondisi=='hilang' ? 'selected':'' }}>Hilang</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('petugas.pengembalians.index') }}" class="btn btn-secondary">Batal</a>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- AJAX Preview --}}
<script>
function loadPreview(){
    const kode = document.getElementById('kode_peminjaman').value.trim();

    if(kode.length > 0){
        fetch('{{ route("petugas.ajax-peminjaman") }}?kode=' + kode)
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    document.getElementById('preview-info').style.display='block';
                    document.getElementById('preview-user').textContent=data.peminjaman.user.name;
                    document.getElementById('preview-buku').textContent=data.peminjaman.buku.judul;
                    document.getElementById('preview-pinjam').textContent=data.peminjaman.tanggal_pinjam;
                    document.getElementById('preview-tempo').textContent=data.peminjaman.tenggat_tempo;
                    document.getElementById('preview-status').textContent=data.peminjaman.status;
                } else {
                    document.getElementById('preview-info').style.display='none';
                }
            });
    } else {
        document.getElementById('preview-info').style.display='none';
    }
}

document.getElementById('kode_peminjaman').addEventListener('input', loadPreview);
window.addEventListener('DOMContentLoaded', loadPreview);
</script>

@endsection