@extends('layouts.app')

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

@section('page-title', 'Detail Buku')

@php
    $routePrefix = auth()->user()->role === 'petugas' ? 'petugas' : 'admin';
@endphp

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header dengan desain buku -->
            <div class="d-flex align-items-center gap-3 mb-4">
                <a href="{{ route($routePrefix . '.alat.index') }}" 
                   class="btn rounded-circle shadow-sm d-flex align-items-center justify-content-center" 
                   style="width: 45px; height: 45px; background: white; color: #8b5a2b; border: 1px solid #e0d5c5;">
                    <i class="bi bi-arrow-left fs-5"></i>
                </a>
                <div>
                    <h3 class="fw-bold mb-1" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">Detail Buku</h3>
                    <p class="mb-0" style="color: #8b7a6b;">Informasi lengkap koleksi perpustakaan</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Bagian Cover Buku -->
                <div class="col-md-5">
                    <div class="card border-0 h-100" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2); overflow: hidden;">
                        <div class="position-relative" style="min-height: 400px; background: linear-gradient(145deg, #f0e7d8 0%, #e8d9c8 100%);">
                            @if($alat->foto)
                                @php
                                    $fotoPath = 'storage/' . $alat->foto;
                                    $fullPath = public_path($fotoPath);
                                @endphp
                                @if(file_exists($fullPath))
                                    <img src="{{ asset($fotoPath) }}" alt="{{ $alat->nama_alat }}" class="w-100 h-100 object-fit-cover">
                                @else
                                    <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                                        <i class="bi bi-journal-bookmark-fill" style="font-size: 5rem; color: #8b5a2b; opacity: 0.5;"></i>
                                        <span class="mt-2 text-muted">Cover tidak ditemukan</span>
                                    </div>
                                @endif
                            @else
                                <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                                    <i class="bi bi-journal-bookmark-fill" style="font-size: 5rem; color: #8b5a2b; opacity: 0.5;"></i>
                                    <span class="mt-2 text-muted">Tidak ada cover</span>
                                </div>
                            @endif
                            
                            <!-- Badge Kategori -->
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge py-2 px-3" style="background: #8b5a2b; color: white; border-radius: 30px;">
                                    <i class="bi bi-tag me-1"></i>{{ $alat->kategori->nama_kategori }}
                                </span>
                            </div>
                            
                            <!-- Efek spine buku -->
                            <div class="position-absolute start-0 top-0 bottom-0" style="width: 15px; background: linear-gradient(to right, rgba(139,90,43,0.2), transparent);"></div>
                        </div>
                    </div>
                </div>

                <!-- Bagian Informasi Buku -->
                <div class="col-md-7">
                    <div class="card border-0 h-100" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2); overflow: hidden;">
                        <div class="card-body p-4">
                            <!-- Header dengan judul dan menu -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h2 class="fw-bold mb-1" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">{{ $alat->nama_alat }}</h2>
                                    <p class="mb-0" style="color: #8b7a6b;">
                                        <i class="bi bi-upc-scan me-1" style="color: #8b5a2b;"></i>ISBN: {{ $alat->kode_alat }}
                                    </p>
                                </div>
                                <div class="dropdown">
                                    <button class="btn" type="button" data-bs-toggle="dropdown" style="background: #f0e7d8; color: #8b5a2b; border-radius: 12px; width: 40px; height: 40px;">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-2" style="border-radius: 16px;">
                                        <li>
                                            <a class="dropdown-item py-2" href="{{ route($routePrefix . '.alat.edit', $alat) }}">
                                                <i class="bi bi-pencil me-2" style="color: #8b5a2b;"></i>Edit Buku
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route($routePrefix . '.alat.destroy', $alat) }}" method="POST" class="delete-form">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="dropdown-item py-2 text-danger" onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                                    <i class="bi bi-trash me-2"></i>Hapus Buku
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Informasi Denda -->
                            <div class="mb-4 p-4" style="background: linear-gradient(145deg, #f0e7d8 0%, #e8d9c8 100%); border-radius: 20px;">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div style="width: 50px; height: 50px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-cash-stack fs-3" style="color: #8b5a2b;"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="small text-muted mb-1">Denda Keterlambatan per Hari</div>
                                        <div class="fs-3 fw-bold" style="color: #8b5a2b;">Rp {{ number_format($alat->harga_sewa_per_hari, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Grid Informasi Stok & Kondisi -->
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <div class="p-4" style="background: #f8f5f0; border-radius: 16px;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div style="width: 40px; height: 40px; background: white; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-layers fs-5" style="color: #8b5a2b;"></i>
                                            </div>
                                            <div>
                                                <div class="small text-muted">Jumlah Eksemplar</div>
                                                <div class="fs-5 fw-bold {{ $alat->stok_tersedia > 0 ? 'text-success' : 'text-danger' }}">
                                                    {{ $alat->stok_tersedia }} / {{ $alat->stok_total }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-4" style="background: #f8f5f0; border-radius: 16px;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div style="width: 40px; height: 40px; background: white; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-clipboard-check fs-5" style="color: #8b5a2b;"></i>
                                            </div>
                                            <div>
                                                <div class="small text-muted">Kondisi</div>
                                                <div class="fs-5 fw-bold">
                                                    @if($alat->kondisi == 'baik') 
                                                        <span class="text-success">Baik</span>
                                                    @elseif($alat->kondisi == 'rusak_ringan')
                                                        <span class="text-warning">Rusak Ringan</span>
                                                    @else
                                                        <span class="text-danger">Rusak Berat</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Penulis & Penerbit -->
                            <div class="row g-4 mb-4">
                                <div class="col-md-4">
                                    <div class="p-3 text-center" style="background: #f8f5f0; border-radius: 12px;">
                                        <i class="bi bi-pencil mb-2" style="color: #8b5a2b;"></i>
                                        <div class="small text-muted">Penulis</div>
                                        <div class="fw-bold" style="color: #4a3b2c;">{{ $alat->penulis ?? '-' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 text-center" style="background: #f8f5f0; border-radius: 12px;">
                                        <i class="bi bi-building mb-2" style="color: #8b5a2b;"></i>
                                        <div class="small text-muted">Penerbit</div>
                                        <div class="fw-bold" style="color: #4a3b2c;">{{ $alat->penerbit ?? '-' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 text-center" style="background: #f8f5f0; border-radius: 12px;">
                                        <i class="bi bi-calendar mb-2" style="color: #8b5a2b;"></i>
                                        <div class="small text-muted">Tahun Terbit</div>
                                        <div class="fw-bold" style="color: #4a3b2c;">{{ $alat->tahun_terbit ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Tambahan (jika ada) -->
                            @if(isset($alat->isbn) || isset($alat->jumlah_halaman) || isset($alat->bahasa))
                            <div class="row g-4 mb-4">
                                @if(isset($alat->isbn))
                                <div class="col-md-4">
                                    <div class="p-3" style="background: #f8f5f0; border-radius: 12px;">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-upc-scan" style="color: #8b5a2b;"></i>
                                            <div>
                                                <div class="small text-muted">ISBN</div>
                                                <div class="fw-bold" style="color: #4a3b2c;">{{ $alat->isbn }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(isset($alat->jumlah_halaman))
                                <div class="col-md-4">
                                    <div class="p-3" style="background: #f8f5f0; border-radius: 12px;">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-file-text" style="color: #8b5a2b;"></i>
                                            <div>
                                                <div class="small text-muted">Halaman</div>
                                                <div class="fw-bold" style="color: #4a3b2c;">{{ $alat->jumlah_halaman }} hal</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(isset($alat->bahasa))
                                <div class="col-md-4">
                                    <div class="p-3" style="background: #f8f5f0; border-radius: 12px;">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-globe" style="color: #8b5a2b;"></i>
                                            <div>
                                                <div class="small text-muted">Bahasa</div>
                                                <div class="fw-bold" style="color: #4a3b2c;">{{ $alat->bahasa }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endif

                            <!-- Deskripsi / Sinopsis -->
                            <div class="mb-4">
                                <h6 class="fw-bold mb-2" style="color: #4a3b2c;">
                                    <i class="bi bi-card-text me-2" style="color: #8b5a2b;"></i>Sinopsis
                                </h6>
                                <div class="p-4" style="background: #f8f5f0; border-radius: 16px;">
                                    <p style="color: #6b5c4d; line-height: 1.6; margin-bottom: 0;">
                                        {{ $alat->deskripsi ?? 'Tidak ada sinopsis untuk buku ini.' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Info Denda -->
                            <div class="p-4" style="background: #fff3cd; border-left: 4px solid #856404; border-radius: 12px;">
                                <div class="d-flex gap-3">
                                    <i class="bi bi-exclamation-triangle-fill fs-4" style="color: #856404;"></i>
                                    <div>
                                        <div class="fw-bold mb-1" style="color: #856404;">Informasi Denda</div>
                                        <div style="color: #856404;">
                                            Keterlambatan pengembalian akan dikenakan denda 
                                            <strong>Rp {{ number_format($alat->harga_sewa_per_hari, 0, ',', '.') }}</strong> per hari.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS Tambahan -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap');

body {
    font-family: 'Inter', sans-serif;
    background: #faf7f2;
}

/* Styling untuk card */
.card {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px -20px rgba(139, 90, 43, 0.3) !important;
}

/* Efek lipatan halaman */
.card::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 30px 30px 0;
    border-color: transparent #f0e7d8 transparent transparent;
    opacity: 0.3;
    z-index: 10;
}

/* Styling untuk gambar */
.object-fit-cover {
    object-fit: cover;
    transition: all 0.5s ease;
}

.card:hover .object-fit-cover {
    transform: scale(1.02);
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f0e7d8;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: #8b5a2b;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: #6b431e;
}

/* Responsive */
@media (max-width: 768px) {
    .card-body {
        padding: 1.5rem !important;
    }
    
    h2 {
        font-size: 1.8rem !important;
    }
    
    .fs-3 {
        font-size: 1.5rem !important;
    }
    
    .row.g-4.mb-4 > .col-md-4 {
        margin-bottom: 1rem;
    }
}
</style>
@endsection