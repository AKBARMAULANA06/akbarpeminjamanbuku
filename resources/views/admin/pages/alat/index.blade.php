@extends('layouts.app')

@section('title', 'Koleksi Buku')

@section('sidebar')
    @if(auth()->user()->role === 'petugas')
        @include('petugas.components.sidebar')
    @else
        @include('admin.components.sidebar')
    @endif
@endsection

@section('navbar')
    @include('layouts.navigation')
@endsection

@php
    $routePrefix = auth()->user()->role === 'petugas' ? 'petugas' : 'admin';
@endphp

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <!-- Header dengan desain buku -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <div class="d-flex align-items-center gap-3 mb-2">
                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-book-half fs-3 text-white"></i>
                </div>
                <div>
                    <h2 class="fw-bold mb-1" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">Koleksi Buku</h2>
                    <p class="mb-0" style="color: #8b7a6b;">
                        <i class="bi bi-stack me-1"></i>Total {{ $alats->total() }} judul buku dalam perpustakaan
                    </p>
                </div>
            </div>
        </div>
        <a href="{{ route($routePrefix . '.alat.create') }}" class="btn d-flex align-items-center px-4 py-3" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 16px; font-weight: 600; border: none; box-shadow: 0 10px 20px -5px rgba(139, 90, 43, 0.3);">
            <i class="bi bi-plus-lg me-2"></i> Tambah Buku Baru
        </a>
    </div>

    <!-- Grid Koleksi Buku -->
    <div class="row g-4">
        @forelse($alats as $alat)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card h-100 border-0" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1); transition: all 0.3s ease; overflow: hidden;">
                    <!-- Book Cover / Image -->
                    <div class="position-relative" style="height: 220px; background: linear-gradient(145deg, #f0e7d8 0%, #e8d9c8 100%); overflow: hidden;">
                        @if($alat->foto)
                            @php
                                $fotoPath = 'storage/' . $alat->foto;
                                $fullPath = public_path($fotoPath);
                            @endphp
                            @if(file_exists($fullPath))
                                <img src="{{ asset($fotoPath) }}" 
                                     class="w-100 h-100" 
                                     alt="{{ $alat->nama_alat }}" 
                                     style="object-fit: cover; width: 100%; height: 100%;">
                            @else
                                <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                                    <i class="bi bi-exclamation-triangle" style="font-size: 3rem; color: #dc3545;"></i>
                                    <span class="mt-2 small text-danger">Gambar tidak ditemukan</span>
                                </div>
                            @endif
                        @else
                            <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                                <i class="bi bi-journal-bookmark-fill" style="font-size: 5rem; color: #8b5a2b; opacity: 0.3;"></i>
                                <span class="mt-2 small" style="color: #8b5a2b; opacity: 0.5;">Tidak Ada Cover</span>
                            </div>
                        @endif
                        
                        <!-- Status Badge -->
                        <div class="position-absolute top-0 end-0 m-3">
                            @if($alat->stok_tersedia > 0)
                                <span class="badge py-2 px-3" style="background: #d4edda; color: #155724; border-radius: 30px; font-weight: 500;">
                                    <i class="bi bi-check-circle-fill me-1" style="font-size: 0.7rem;"></i> Tersedia
                                </span>
                            @else
                                <span class="badge py-2 px-3" style="background: #f8d7da; color: #721c24; border-radius: 30px; font-weight: 500;">
                                    <i class="bi bi-x-circle-fill me-1" style="font-size: 0.7rem;"></i> Dipinjam
                                </span>
                            @endif
                        </div>

                        <!-- Book Spine Effect -->
                        <div class="position-absolute start-0 top-0 bottom-0" style="width: 15px; background: linear-gradient(to right, rgba(139,90,43,0.2), transparent);"></div>
                    </div>
                    
                    <!-- Book Details -->
                    <div class="card-body p-4">
                        <!-- Kategori -->
                        <div class="mb-3">
                            <span class="badge py-2 px-3" style="background: #f0e7d8; color: #8b5a2b; border-radius: 30px; font-size: 0.8rem;">
                                <i class="bi bi-tag me-1"></i>{{ $alat->kategori->nama_kategori }}
                            </span>
                        </div>

                        <!-- Judul Buku -->
                        <h5 class="fw-bold mb-2" style="color: #4a3b2c; font-family: 'Playfair Display', serif; font-size: 1.1rem;" title="{{ $alat->nama_alat }}">
                            {{ Str::limit($alat->nama_alat, 40) }}
                        </h5>
                        
                        <!-- Kode Buku -->
                        <p class="small mb-3" style="color: #8b7a6b;">
                            <i class="bi bi-upc-scan me-1"></i>ISBN: {{ $alat->kode_alat }}
                        </p>
                        
                        <!-- Divider dengan ornamen buku -->
                        <div class="d-flex align-items-center gap-2 my-3">
                            <div style="flex: 1; height: 1px; background: linear-gradient(to right, transparent, #e0d5c5, transparent);"></div>
                            <i class="bi bi-bookmark" style="color: #8b5a2b; font-size: 0.8rem;"></i>
                            <div style="flex: 1; height: 1px; background: linear-gradient(to right, transparent, #e0d5c5, transparent);"></div>
                        </div>

                        <!-- Info Stok & Harga -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <span class="small text-muted d-block">Denda per Hari</span>
                                <span class="fw-bold" style="color: #2b5f4e; font-size: 1.1rem;">Rp {{ number_format($alat->harga_sewa_per_hari, 0, ',', '.') }}</span>
                            </div>
                            <div class="text-end">
                                <span class="small text-muted d-block">Eksemplar</span>
                                <span class="fw-bold" style="color: #4a3b2c;">{{ $alat->stok_tersedia }}/{{ $alat->stok_total }}</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2">
                            <a href="{{ route($routePrefix . '.alat.show', $alat) }}" class="btn flex-grow-1 d-flex align-items-center justify-content-center" style="background: #f0e7d8; color: #8b5a2b; border-radius: 12px; font-weight: 500; padding: 10px;">
                                <i class="bi bi-eye me-2"></i> Detail
                            </a>
                            <a href="{{ route($routePrefix . '.alat.edit', $alat) }}" class="btn" style="background: #f0e7d8; color: #8b5a2b; border-radius: 12px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route($routePrefix . '.alat.destroy', $alat) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn" style="background: #f0e7d8; color: #dc3545; border-radius: 12px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;" onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State dengan tema buku -->
            <div class="col-12">
                <div class="card border-0 py-5" style="background: white; border-radius: 32px; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1);">
                    <div class="card-body text-center py-5">
                        <div style="font-size: 120px; opacity: 0.3; margin-bottom: 20px;">
                            📚
                        </div>
                        <h3 class="fw-bold mb-3" style="color: #4a3b2c;">Belum Ada Koleksi Buku</h3>
                        <p class="text-muted mb-4" style="color: #8b7a6b; max-width: 400px; margin: 0 auto;">
                            Mulai tambahkan koleksi buku pertama Anda ke perpustakaan.
                        </p>
                        <a href="{{ route($routePrefix . '.alat.create') }}" class="btn d-inline-flex align-items-center px-5 py-3" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 16px; font-weight: 600; border: none;">
                            <i class="bi bi-plus-lg me-2"></i> Tambah Buku Pertama
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination dengan styling buku -->
@if($alats->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            <div class="pagination-wrapper" style="background: white; padding: 10px; border-radius: 50px; box-shadow: 0 5px 15px -5px rgba(100, 70, 40, 0.2);">
                {{ $alats->links() }}
            </div>
        </div>
    @endif
</div>
@endsection