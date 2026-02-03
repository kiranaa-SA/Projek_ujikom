{{-- resources/views/frontend/buku/index.blade.php --}}
@extends('layouts.app') {{-- ini layout frontend kamu (navbar & footer) --}}

@section('title', 'Daftar Buku')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">📚 Daftar Buku</h2>

    <div class="row g-4">
        @forelse($bukus as $buku)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                @if($buku->gambar)
                    <img src="{{ asset('storage/' . $buku->gambar) }}" 
                         class="card-img-top" 
                         alt="{{ $buku->judul }}" 
                         style="height: 200px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/200x200?text=No+Image" 
                         class="card-img-top" 
                         alt="Tidak ada gambar">
                @endif

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $buku->judul }}</h5>
                    <p class="card-text text-muted mb-2">
                        {{ Str::limit($buku->deskripsi, 80, '...') }}
                    </p>
                    <small class="text-secondary">
                        <strong>Penulis:</strong> {{ $buku->penulis }} <br>
                        <strong>Kategori:</strong> {{ $buku->kategori->nama ?? '-' }}
                    </small>
                    <div class="mt-auto">
                        <a href="{{ route('frontend.buku.show', $buku->id) }}" class="btn btn-primary w-100 mt-3">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-muted">Belum ada buku tersedia.</p>
        @endforelse
    </div>
</div>
@endsection
