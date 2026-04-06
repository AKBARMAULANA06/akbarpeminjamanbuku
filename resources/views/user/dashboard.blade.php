@extends('layouts.app')

@section('title', 'Dashboard Anggota')

@section('sidebar')
    @include('user.components.sidebar')
@endsection

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <!-- Hero Section dengan desain buku -->
    <div class="hero-welcome mb-5" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 30px; padding: 2.5rem; box-shadow: 0 20px 40px -10px rgba(139, 90, 43, 0.3);">
        <div class="row align-items-center position-relative" style="z-index: 1;">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold text-white mb-3" style="font-family: 'Playfair Display', serif; text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">
                    Halo, {{ auth()->user()->name }}! <i class="bi bi-emoji-smile-fill text-warning"></i>
                </h1>
                <p class="text-white opacity-90 mb-4 fs-5">Selamat datang di Perpustakaan Digital. Temukan buku favoritmu dan mulailah petualangan membaca!</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('user.peminjaman.create') }}" class="btn d-flex align-items-center px-4 py-2" style="background: white; color: #8b5a2b; border-radius: 50px; font-weight: 600; box-shadow: 0 5px 15px rgba(0,0,0,0.2);">
                        <i class="bi bi-book me-2"></i> Pinjam Buku
                    </a>
                    <a href="{{ route('user.peminjaman.index') }}" class="btn d-flex align-items-center px-4 py-2" style="background: rgba(255,255,255,0.2); color: white; border-radius: 50px; font-weight: 600; backdrop-filter: blur(5px); border: 1px solid rgba(255,255,255,0.3);">
                        <i class="bi bi-journal-text me-2"></i> Riwayat Peminjaman
                    </a>
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block text-center">
                <div style="font-size: 8rem; opacity: 0.3; transform: rotate(-10deg);">
                    📚
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 h-100" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div style="width: 50px; height: 50px; background: #f0e7d8; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                            <i class="bi bi-journal-bookmark-fill fs-4" style="color: #8b5a2b;"></i>
                        </div>
                        <div>
                            <div class="small text-muted">Total Peminjaman</div>
                            <div class="fs-3 fw-bold" style="color: #4a3b2c;">{{ $stats['total_peminjaman'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 h-100" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div style="width: 50px; height: 50px; background: #fff3cd; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                            <i class="bi bi-hourglass-split fs-4" style="color: #856404;"></i>
                        </div>
                        <div>
                            <div class="small text-muted">Menunggu</div>
                            <div class="fs-3 fw-bold" style="color: #856404;">{{ $stats['pending'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 h-100" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div style="width: 50px; height: 50px; background: #d4edda; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                            <i class="bi bi-check-circle-fill fs-4" style="color: #155724;"></i>
                        </div>
                        <div>
                            <div class="small text-muted">Sedang Dipinjam</div>
                            <div class="fs-3 fw-bold" style="color: #155724;">{{ $stats['approved'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 h-100" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div style="width: 50px; height: 50px; background: #d1ecf1; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                            <i class="bi bi-arrow-return-left fs-4" style="color: #0c5460;"></i>
                        </div>
                        <div>
                            <div class="small text-muted">Dikembalikan</div>
                            <div class="fs-3 fw-bold" style="color: #0c5460;">{{ $stats['returned'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Rekomendasi Buku -->
        <div class="col-xl-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">
                    <i class="bi bi-star-fill me-2" style="color: #8b5a2b;"></i>Rekomendasi Buku
                </h4>
                <a href="{{ route('user.peminjaman.create') }}" class="text-decoration-none fw-semibold" style="color: #8b5a2b;">
                    Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            
            <div class="row g-3">
                @forelse($alat_tersedia as $buku)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 h-100" style="border-radius: 20px; background: white; box-shadow: 0 10px 25px -8px rgba(100, 70, 40, 0.15); overflow: hidden;">
                            <!-- Cover Buku -->
                            <div class="position-relative" style="height: 150px; background: linear-gradient(145deg, #f0e7d8 0%, #e8d9c8 100%);">
                                @if($buku->foto)
                                    @php
                                        $fotoPath = 'storage/' . $buku->foto;
                                        $fullPath = public_path($fotoPath);
                                    @endphp
                                    @if(file_exists($fullPath))
                                        <img src="{{ asset($fotoPath) }}" class="w-100 h-100 object-fit-cover" alt="{{ $buku->nama_alat }}">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-journal-bookmark-fill" style="font-size: 3rem; color: #8b5a2b; opacity: 0.5;"></i>
                                        </div>
                                    @endif
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-journal-bookmark-fill" style="font-size: 3rem; color: #8b5a2b; opacity: 0.5;"></i>
                                    </div>
                                @endif
                                
                                <!-- Spine Effect -->
                                <div class="position-absolute start-0 top-0 bottom-0" style="width: 8px; background: linear-gradient(to right, rgba(139,90,43,0.3), transparent);"></div>
                            </div>
                            
                            <div class="card-body p-3">
                                <!-- Kategori -->
                                <span class="badge py-1 px-2 mb-2" style="background: #f0e7d8; color: #8b5a2b; border-radius: 30px; font-size: 0.7rem;">
                                    <i class="bi bi-tag me-1"></i>{{ $buku->kategori->nama_kategori }}
                                </span>
                                
                                <!-- Judul Buku -->
                                <h6 class="fw-bold mb-1 text-truncate" style="color: #4a3b2c;" title="{{ $buku->nama_alat }}">
                                    {{ $buku->nama_alat }}
                                </h6>
                                
                                <!-- Penulis (jika ada) -->
                                @if(isset($buku->penulis))
                                    <p class="small text-muted mb-2">
                                        <i class="bi bi-pencil"></i> {{ $buku->penulis }}
                                    </p>
                                @endif
                                
                                <!-- Info -->
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div>
                                        <span class="small text-muted">Denda/hari</span>
                                        <span class="fw-bold d-block" style="color: #2b5f4e;">Rp {{ number_format($buku->harga_sewa_per_hari, 0, ',', '.') }}</span>
                                    </div>
                                    <span class="small text-muted">
                                        <i class="bi bi-layers me-1"></i>{{ $buku->stok_tersedia }} eks.
                                    </span>
                                </div>
                                
                                <!-- Tombol Pinjam -->
                                <a href="{{ route('user.peminjaman.create') }}" class="btn w-100 mt-3 py-2" style="background: #f0e7d8; color: #8b5a2b; border-radius: 30px; font-weight: 500;">
                                    <i class="bi bi-bookmark-plus me-1"></i> Pinjam Buku
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert d-flex align-items-center p-4" style="background: #f0e7d8; color: #8b5a2b; border: none; border-radius: 20px;">
                            <i class="bi bi-info-circle-fill me-3 fs-4"></i>
                            <div>Belum ada buku yang tersedia saat ini.</div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Aktivitas Terakhir -->
        <div class="col-xl-4">
            <div class="card border-0 h-100" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1); overflow: hidden;">
                <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
                    <h5 class="mb-0 fw-bold" style="color: #4a3b2c;">
                        <i class="bi bi-clock-history me-2" style="color: #8b5a2b;"></i>Aktivitas Terakhir
                    </h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($recent_peminjaman as $p)
                            <li class="list-group-item p-3 border-0 border-bottom" style="border-color: #f0e7d8 !important;">
                                <div class="d-flex">
                                    <div style="width: 45px; height: 45px; background: #f0e7d8; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                        <i class="bi bi-journal-text" style="color: #8b5a2b;"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold" style="color: #4a3b2c;">{{ $p->alat->nama_alat }}</div>
                                        <div class="small text-muted mb-1">
                                            <i class="bi bi-calendar3 me-1"></i>{{ $p->tanggal_pinjam->format('d M') }} - {{ $p->tanggal_kembali_rencana->format('d M') }}
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                @if($p->status == 'pending')
                                                    <span class="badge py-1 px-2" style="background: #fff3cd; color: #856404; border-radius: 30px;">
                                                        <i class="bi bi-hourglass-split me-1"></i>Menunggu
                                                    </span>
                                                @elseif($p->status == 'approved')
                                                    <span class="badge py-1 px-2" style="background: #d4edda; color: #155724; border-radius: 30px;">
                                                        <i class="bi bi-check-circle me-1"></i>Dipinjam
                                                    </span>
                                                @elseif($p->status == 'returned')
                                                    <span class="badge py-1 px-2" style="background: #d1ecf1; color: #0c5460; border-radius: 30px;">
                                                        <i class="bi bi-arrow-return-left me-1"></i>Selesai
                                                    </span>
                                                @endif
                                            </div>
                                            <span class="fw-bold" style="color: #8b5a2b;">Rp {{ number_format($p->total_biaya, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('user.peminjaman.index') }}" class="ms-2 d-flex align-items-center" style="color: #8b5a2b;">
                                        <i class="bi bi-chevron-right fs-5"></i>
                                    </a>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item p-5 text-center">
                                <div style="font-size: 4rem; opacity: 0.3; margin-bottom: 15px;">📖</div>
                                <p class="text-muted mb-0">Belum ada riwayat peminjaman.</p>
                                <a href="{{ route('user.peminjaman.create') }}" class="btn mt-3" style="background: #f0e7d8; color: #8b5a2b; border-radius: 30px;">
                                    <i class="bi bi-book me-2"></i>Pinjam Buku Sekarang
                                </a>
                            </li>
                        @endforelse
                    </ul>
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
    box-shadow: 0 20px 40px -15px rgba(139, 90, 43, 0.3) !important;
}

/* Efek lipatan halaman untuk card */
.card::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 25px 25px 0;
    border-color: transparent #f0e7d8 transparent transparent;
    opacity: 0.3;
    z-index: 10;
}

/* Animasi untuk emoji buku */
@keyframes float {
    0%, 100% { transform: rotate(-10deg) translateY(0); }
    50% { transform: rotate(-10deg) translateY(-10px); }
}

.col-lg-4 div[style*="font-size: 8rem"] {
    animation: float 5s ease-in-out infinite;
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
    .hero-welcome {
        padding: 1.5rem !important;
    }
    
    .display-5 {
        font-size: 1.8rem !important;
    }
}
</style>
@endsection