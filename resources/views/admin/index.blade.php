@extends('layouts.app')

@section('title', 'Dashboard Perpustakaan')

@section('sidebar')
    @include('admin.components.sidebar')
@endsection

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header dengan gradient -->
    <div class="hero-welcome mb-5" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 30px; padding: 2rem; box-shadow: 0 20px 40px -10px rgba(139, 90, 43, 0.3);">
        <div class="d-flex justify-content-between align-items-center position-relative" style="z-index: 1;">
            <div>
                <h1 class="display-5 fw-bold text-white mb-2" style="font-family: 'Playfair Display', serif; text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">
                    Selamat Datang, Admin! <i class="bi bi-stars text-warning"></i>
                </h1>
                <p class="text-white opacity-90 mb-0 fs-5">
                    <i class="bi bi-calendar3 me-2"></i>{{ now()->translatedFormat('l, d F Y') }}
                </p>
                <p class="text-white opacity-75 mt-2 mb-0" style="max-width: 500px;">
                    <i class="bi bi-info-circle me-2"></i>Ini ringkasan aktivitas perpustakaan hari ini.
                </p>
            </div>
            <div class="d-none d-md-block">
                <div style="font-size: 80px; opacity: 0.3; position: absolute; bottom: -10px; right: 20px;">
                    📚
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards dengan warna yang lebih hidup -->
    <div class="row g-4 mb-5">
        <!-- Total Anggota -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-0" style="background: linear-gradient(145deg, #667eea 0%, #764ba2 100%); border-radius: 24px; box-shadow: 0 15px 35px -10px rgba(102, 126, 234, 0.4);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 16px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
                            <i class="bi bi-people-fill fs-2 text-white"></i>
                        </div>
                        <div>
                            <div class="small text-white opacity-75 fw-medium">Total Anggota</div>
                            <div class="fs-1 fw-bold text-white">{{ $stats['total_users'] }}</div>
                        </div>
                    </div>
                    <div class="mt-3 d-flex align-items-center gap-2">
                        <span class="badge bg-white text-primary px-3 py-2 rounded-pill">
                            <i class="bi bi-arrow-up-short me-1"></i>+12%
                        </span>
                        <span class="text-white opacity-75 small">dari bulan lalu</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Buku -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-0" style="background: linear-gradient(145deg, #43e97b 0%, #38f9d7 100%); border-radius: 24px; box-shadow: 0 15px 35px -10px rgba(67, 233, 123, 0.4);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 16px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
                            <i class="bi bi-book-half fs-2 text-white"></i>
                        </div>
                        <div>
                            <div class="small text-white opacity-75 fw-medium">Total Buku</div>
                            <div class="fs-1 fw-bold text-white">{{ $stats['total_alat'] ?? 0 }}</div>
                        </div>
                    </div>
                    <div class="mt-3 d-flex align-items-center gap-2">
                        <span class="badge bg-white text-success px-3 py-2 rounded-pill">
                            <i class="bi bi-box me-1"></i>{{ \App\Models\Alat::sum('stok_tersedia') ?? 0 }} Tersedia
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Peminjaman -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-0" style="background: linear-gradient(145deg, #f6d365 0%, #fda085 100%); border-radius: 24px; box-shadow: 0 15px 35px -10px rgba(246, 211, 101, 0.4);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 16px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
                            <i class="bi bi-hourglass-split fs-2 text-white"></i>
                        </div>
                        <div>
                            <div class="small text-white opacity-75 fw-medium">Pending Peminjaman</div>
                            <div class="fs-1 fw-bold text-white">{{ $stats['peminjaman_pending'] }}</div>
                        </div>
                    </div>
                    @if($stats['peminjaman_pending'] > 0)
                        <a href="{{ route('admin.peminjaman.index', ['status' => 'pending']) }}" class="mt-3 d-flex align-items-center gap-2 text-white text-decoration-none">
                            <span class="badge bg-white text-warning px-3 py-2 rounded-pill">
                                <i class="bi bi-arrow-right me-1"></i>Review Request
                            </span>
                        </a>
                    @else
                        <div class="mt-3 d-flex align-items-center gap-2">
                            <span class="badge bg-white text-success px-3 py-2 rounded-pill">
                                <i class="bi bi-check-circle me-1"></i>Semua Clear
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sedang Dipinjam -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-0" style="background: linear-gradient(145deg, #fa709a 0%, #fee140 100%); border-radius: 24px; box-shadow: 0 15px 35px -10px rgba(250, 112, 154, 0.4);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 16px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
                            <i class="bi bi-journal-check fs-2 text-white"></i>
                        </div>
                        <div>
                            <div class="small text-white opacity-75 fw-medium">Sedang Dipinjam</div>
                            <div class="fs-1 fw-bold text-white">{{ $stats['peminjaman_approved'] }}</div>
                        </div>
                    </div>
                    <div class="mt-3 d-flex align-items-center gap-2">
                        <span class="badge bg-white text-info px-3 py-2 rounded-pill">
                            <i class="bi bi-book me-1"></i>Buku sedang dibaca
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions dengan desain lebih menarik -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card border-0" style="background: white; border-radius: 24px; box-shadow: 0 10px 30px -10px rgba(0,0,0,0.1);">
                <div class="card-header bg-transparent border-0 p-4">
                    <h5 class="mb-0 fw-bold" style="color: #4a3b2c;">
                        <i class="bi bi-lightning-charge-fill me-2" style="color: #fbbf24;"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body p-4 pt-0">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="{{ route('admin.alat.create') }}" class="btn d-flex align-items-center justify-content-center p-4 w-100" style="background: linear-gradient(145deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 20px; font-weight: 600; border: none;">
                                <i class="bi bi-plus-circle me-2 fs-5"></i>
                                <span>Tambah Buku Baru</span>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.kategori.create') }}" class="btn d-flex align-items-center justify-content-center p-4 w-100" style="background: linear-gradient(145deg, #4f46e5 0%, #6366f1 100%); color: white; border-radius: 20px; font-weight: 600; border: none;">
                                <i class="bi bi-folder-plus me-2 fs-5"></i>
                                <span>Tambah Kategori</span>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.peminjaman.index') }}" class="btn d-flex align-items-center justify-content-center p-4 w-100" style="background: linear-gradient(145deg, #059669 0%, #10b981 100%); color: white; border-radius: 20px; font-weight: 600; border: none;">
                                <i class="bi bi-list-ul me-2 fs-5"></i>
                                <span>Kelola Peminjaman</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Peminjaman Terbaru -->
    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0" style="background: white; border-radius: 24px; box-shadow: 0 10px 30px -10px rgba(0,0,0,0.1);">
                <div class="card-header bg-transparent border-0 p-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold" style="color: #4a3b2c;">
                        <i class="bi bi-bookmarks me-2" style="color: #8b5a2b;"></i>
                        Peminjaman Terbaru
                    </h5>
                    <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-sm" style="background: #f0e7d8; color: #8b5a2b; border-radius: 20px; padding: 8px 20px; font-weight: 500;">
                        Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead style="background: #f8f5f0;">
                                <tr>
                                    <th class="px-4 py-3" style="color: #6b5c4d; font-weight: 600;">Peminjam</th>
                                    <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Judul Buku</th>
                                    <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Durasi</th>
                                    <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Status</th>
                                    <th class="px-4 py-3" style="color: #6b5c4d; font-weight: 600;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recent_peminjaman as $p)
                                    <tr>
                                        <td class="px-4">
                                            <div class="d-flex align-items-center">
                                                <div style="width: 40px; height: 40px; background: linear-gradient(145deg, #8b5a2b 0%, #a8753a 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 12px; color: white; font-weight: 600;">
                                                    {{ strtoupper(substr($p->user->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="fw-bold" style="color: #4a3b2c;">{{ $p->user->name }}</div>
                                                    <div class="small" style="color: #8b7a6b;">#{{ $p->id }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-medium" style="color: #4a3b2c;">{{ $p->alat->nama_alat }}</span>
                                        </td>
                                        <td>
                                            <div class="small text-muted">{{ $p->tanggal_pinjam->format('d/m') }} - {{ $p->tanggal_kembali_rencana->format('d/m') }}</div>
                                            <div class="small fw-bold" style="color: #8b5a2b;">{{ $p->durasi_hari }} Hari</div>
                                        </td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'pending' => ['bg' => '#fff3cd', 'text' => '#856404'],
                                                    'approved' => ['bg' => '#d4edda', 'text' => '#155724'],
                                                    'returned' => ['bg' => '#d1ecf1', 'text' => '#0c5460'],
                                                    'rejected' => ['bg' => '#f8d7da', 'text' => '#721c24']
                                                ];
                                                $statusLabels = [
                                                    'pending' => 'Menunggu',
                                                    'approved' => 'Disetujui',
                                                    'returned' => 'Dikembalikan',
                                                    'rejected' => 'Ditolak'
                                                ];
                                                $color = $statusColors[$p->status] ?? ['bg' => '#e2e3e5', 'text' => '#383d41'];
                                            @endphp
                                            <span style="background: {{ $color['bg'] }}; color: {{ $color['text'] }}; padding: 6px 16px; border-radius: 30px; font-size: 0.85rem; font-weight: 600;">
                                                {{ $statusLabels[$p->status] ?? $p->status }}
                                            </span>
                                        </td>
                                        <td class="px-4">
                                            <a href="{{ route('admin.peminjaman.show', $p) }}" style="color: #8b5a2b; font-size: 1.2rem; background: #f0e7d8; width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px;">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div style="font-size: 80px; opacity: 0.3;">📚</div>
                                            <p class="mt-3 fs-5" style="color: #8b7a6b;">Belum ada aktivitas peminjaman.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Font untuk judul */
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap');

body {
    font-family: 'Inter', sans-serif;
    background: #faf7f2;
}

.hero-title {
    font-family: 'Playfair Display', serif;
}

/* Hover effect untuk card */
.card {
    transition: all 0.3s ease;
    overflow: hidden;
    position: relative;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px -15px rgba(0,0,0,0.2) !important;
}

.card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: rgba(255,255,255,0.1);
    transform: rotate(45deg);
    transition: all 0.6s ease;
    opacity: 0;
}

.card:hover::before {
    opacity: 1;
    transform: rotate(45deg) translate(10%, 10%);
}

/* Styling untuk table */
.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background: #f8f5f0;
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

/* Button styles */
.btn {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px -5px rgba(0,0,0,0.2);
}

/* Responsive */
@media (max-width: 768px) {
    .hero-welcome {
        padding: 1.5rem !important;
    }
    
    .hero-welcome h1 {
        font-size: 1.8rem;
    }
    
    .card {
        margin-bottom: 1rem;
    }
}

/* Animasi untuk icon */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.bi-stars {
    animation: float 3s ease-in-out infinite;
    display: inline-block;
}
</style>
@endsection