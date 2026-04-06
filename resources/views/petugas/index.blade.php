@extends('layouts.app')

@section('title', 'Dashboard Petugas Perpustakaan')

@section('sidebar')
    @include('petugas.components.sidebar')
@endsection

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <!-- Hero Section dengan desain buku -->
    <div class="hero-welcome mb-5" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 30px; padding: 2.5rem; box-shadow: 0 20px 40px -10px rgba(139, 90, 43, 0.3);">
        <div class="d-flex justify-content-between align-items-center position-relative" style="z-index: 1;">
            <div>
                <h1 class="display-5 fw-bold text-white mb-2" style="font-family: 'Playfair Display', serif; text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">
                    Halo, Petugas! <i class="bi bi-person-badge text-warning"></i>
                </h1>
                <p class="text-white opacity-90 mb-0 fs-5">
                    <i class="bi bi-calendar3 me-2"></i>{{ now()->translatedFormat('l, d F Y') }}
                </p>
                <p class="text-white opacity-75 mt-2 mb-0">
                    <i class="bi bi-info-circle me-2"></i>Selamat bertugas, kelola peminjaman buku dengan baik.
                </p>
            </div>
            <div class="d-none d-md-block">
                <div style="font-size: 100px; opacity: 0.2; transform: rotate(-10deg);">
                    📚
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 h-100" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 60px; height: 60px; background: #fff3cd; border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-hourglass-split fs-2" style="color: #856404;"></i>
                        </div>
                        <div>
                            <span class="small text-muted text-uppercase">Perlu Persetujuan</span>
                            <h3 class="fw-bold mb-0" style="color: #856404;">{{ \App\Models\Peminjaman::where('status', 'pending')->count() }}</h3>
                            <small class="text-muted">Menunggu review</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 h-100" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 60px; height: 60px; background: #d4edda; border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-book fs-2" style="color: #155724;"></i>
                        </div>
                        <div>
                            <span class="small text-muted text-uppercase">Sedang Dipinjam</span>
                            <h3 class="fw-bold mb-0" style="color: #155724;">{{ \App\Models\Peminjaman::where('status', 'approved')->count() }}</h3>
                            <small class="text-muted">Buku sedang dibaca</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 h-100" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 60px; height: 60px; background: #d1ecf1; border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-arrow-return-left fs-2" style="color: #0c5460;"></i>
                        </div>
                        <div>
                            <span class="small text-muted text-uppercase">Sudah Dikembalikan</span>
                            <h3 class="fw-bold mb-0" style="color: #0c5460;">{{ \App\Models\Peminjaman::where('status', 'returned')->count() }}</h3>
                            <small class="text-muted">Selesai</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Utama -->
    <div class="card border-0" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2); overflow: hidden;">
        <!-- Card Header -->
        <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-journal-text" style="color: #8b5a2b;"></i>
                <span class="fw-medium" style="color: #6b5c4d;">Permintaan Peminjaman Terbaru</span>
                <span class="ms-auto badge py-2 px-3" style="background: #f0e7d8; color: #8b5a2b;">
                    {{ \App\Models\Peminjaman::where('status', 'pending')->count() }} Menunggu
                </span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0" style="border-collapse: separate; border-spacing: 0;">
                <thead style="background: #f8f5f0;">
                    <tr>
                        <th class="ps-4 py-3" style="color: #6b5c4d; font-weight: 600;">Peminjam</th>
                        <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Judul Buku</th>
                        <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Tanggal Pinjam</th>
                        <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Status</th>
                        <th class="text-end pe-4 py-3" style="color: #6b5c4d; font-weight: 600;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $pending = \App\Models\Peminjaman::with(['user', 'alat'])
                            ->where('status', 'pending')
                            ->orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get();
                    @endphp
                    @forelse($pending as $p)
                        <tr style="border-bottom: 1px solid #f0e7d8;">
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                        {{ strtoupper(substr($p->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold" style="color: #4a3b2c;">{{ $p->user->name }}</div>
                                        <small style="color: #8b7a6b;">{{ $p->user->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-journal-bookmark-fill" style="color: #8b5a2b;"></i>
                                    <span style="color: #4a3b2c;">{{ $p->alat->nama_alat }}</span>
                                </div>
                            </td>
                            <td class="py-3">
                                <span style="color: #6b5c4d;">{{ $p->tanggal_pinjam->format('d M Y') }}</span>
                            </td>
                            <td class="py-3">
                                <span class="badge py-2 px-3" style="background: #fff3cd; color: #856404; border-radius: 30px;">
                                    <i class="bi bi-hourglass-split me-1"></i>Menunggu
                                </span>
                            </td>
                            <td class="text-end pe-4 py-3">
                                <a href="{{ route('petugas.peminjaman.show', $p) }}" class="btn d-inline-flex align-items-center" 
                                   style="background: #f0e7d8; color: #8b5a2b; border-radius: 30px; padding: 8px 20px; font-weight: 500;">
                                    <i class="bi bi-eye me-2"></i>Proses
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div style="font-size: 80px; opacity: 0.2; margin-bottom: 20px;">
                                    📖
                                </div>
                                <i class="bi bi-journal-check" style="font-size: 3rem; color: #8b5a2b; opacity: 0.3; margin-bottom: 15px;"></i>
                                <p class="text-muted mb-0" style="color: #8b7a6b;">Belum ada permintaan peminjaman baru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Card Footer -->
        @if($pending->count() > 0)
        <div class="card-footer bg-transparent border-0 p-4 text-end" style="border-top: 2px solid #f0e7d8;">
            <a href="{{ route('petugas.peminjaman.index') }}" class="btn d-inline-flex align-items-center" style="color: #8b5a2b; text-decoration: none;">
                <span>Kelola Semua Peminjaman</span>
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
        @endif
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
    border-width: 0 40px 40px 0;
    border-color: transparent #f0e7d8 transparent transparent;
    opacity: 0.3;
    z-index: 10;
}

/* Styling untuk tabel */
.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background: #f8f5f0;
}

/* Styling untuk badge */
.badge {
    font-weight: 500;
    letter-spacing: 0.3px;
}

/* Animasi untuk emoji buku */
@keyframes float {
    0%, 100% { transform: rotate(-10deg) translateY(0); }
    50% { transform: rotate(-10deg) translateY(-10px); }
}

.d-none.d-md-block div[style*="font-size: 100px"] {
    animation: float 4s ease-in-out infinite;
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
    
    .card-body {
        padding: 1rem;
    }
}
</style>
@endsection