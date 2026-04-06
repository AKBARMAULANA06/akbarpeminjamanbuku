@extends('layouts.app')

@section('title', 'Peminjaman Buku')

@php
    $routePrefix = auth()->user()->role === 'petugas' ? 'petugas.' : 'admin.';
@endphp

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

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <!-- Header dengan desain buku -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <div class="d-flex align-items-center gap-3 mb-2">
                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-journal-bookmark-fill fs-3 text-white"></i>
                </div>
                <div>
                    <h2 class="fw-bold mb-1" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">Peminjaman Buku</h2>
                    <p class="mb-0" style="color: #8b7a6b;">Monitor dan kelola status peminjaman buku anggota</p>
                </div>
            </div>
        </div>
        
        <!-- Filter Status dengan desain buku -->
        <div class="bg-white p-2 rounded-pill border shadow-sm d-inline-flex" style="border-color: #e0d5c5 !important;">
            <a href="{{ route($routePrefix . 'peminjaman.index') }}" 
               class="px-4 py-2 rounded-pill text-decoration-none fw-bold small {{ !request('status') ? 'text-white' : 'text-muted' }}"
               style="{{ !request('status') ? 'background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); box-shadow: 0 5px 10px -3px rgba(139, 90, 43, 0.3);' : '' }}">
               <i class="bi bi-collection me-1"></i> Semua
            </a>
            <a href="{{ route($routePrefix . 'peminjaman.index', ['status' => 'pending']) }}" 
               class="px-4 py-2 rounded-pill text-decoration-none fw-bold small {{ request('status') == 'pending' ? 'text-dark' : 'text-muted' }}"
               style="{{ request('status') == 'pending' ? 'background: #f0e7d8; box-shadow: 0 5px 10px -3px rgba(139, 90, 43, 0.2);' : '' }}">
               <i class="bi bi-hourglass-split me-1"></i> Menunggu
            </a>
            <a href="{{ route($routePrefix . 'peminjaman.index', ['status' => 'approved']) }}" 
               class="px-4 py-2 rounded-pill text-decoration-none fw-bold small {{ request('status') == 'approved' ? 'text-white' : 'text-muted' }}"
               style="{{ request('status') == 'approved' ? 'background: #2b5f4e; box-shadow: 0 5px 10px -3px rgba(43, 95, 78, 0.3);' : '' }}">
               <i class="bi bi-book me-1"></i> Dipinjam
            </a>
            <a href="{{ route($routePrefix . 'peminjaman.index', ['status' => 'returned']) }}" 
               class="px-4 py-2 rounded-pill text-decoration-none fw-bold small {{ request('status') == 'returned' ? 'text-white' : 'text-muted' }}"
               style="{{ request('status') == 'returned' ? 'background: #6c757d; box-shadow: 0 5px 10px -3px rgba(108, 117, 125, 0.3);' : '' }}">
               <i class="bi bi-check-circle me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Card Utama -->
    <div class="card border-0" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2); overflow: hidden;">
        <!-- Card Header dengan ornamen buku -->
        <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-journal-text" style="color: #8b5a2b;"></i>
                <span class="fw-medium" style="color: #6b5c4d;">Daftar Peminjaman Buku</span>
                <span class="ms-auto badge py-2 px-3" style="background: #f0e7d8; color: #8b5a2b;">
                    Total: {{ $peminjamans->total() }} Transaksi
                </span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0" style="border-collapse: separate; border-spacing: 0;">
                <thead style="background: #f8f5f0;">
                    <tr>
                        <th class="ps-4 py-3" style="color: #6b5c4d; font-weight: 600;">ID Transaksi</th>
                        <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Anggota</th>
                        <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Buku & Durasi</th>
                        <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Tanggal Peminjaman</th>
                        <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Status</th>
                        <th class="text-end pe-4 py-3" style="color: #6b5c4d; font-weight: 600;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $p)
                        <tr style="border-bottom: 1px solid #f0e7d8;">
                            <td class="ps-4 py-3">
                                <span class="fw-bold" style="color: #4a3b2c;">#{{ $p->id }}</span>
                                <div class="small" style="color: #8b7a6b;">
                                    <i class="bi bi-clock me-1"></i>{{ $p->created_at->diffForHumans() }}
                                </div>
                            </td>
                            <td class="py-3">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center justify-content-center me-3" 
                                         style="width: 45px; height: 45px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 12px; color: white; font-weight: 600; font-size: 1.2rem;">
                                        {{ strtoupper(substr($p->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold" style="color: #4a3b2c;">{{ $p->user->name }}</div>
                                        <div class="small" style="color: #8b7a6b;">{{ $p->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-book me-2" style="color: #8b5a2b;"></i>
                                    <span class="fw-medium" style="color: #4a3b2c;">{{ $p->alat->nama_alat }}</span>
                                </div>
                                <span class="badge py-2 px-3" style="background: #f0e7d8; color: #8b5a2b; border-radius: 30px;">
                                    <i class="bi bi-calendar-week me-1"></i> {{ $p->durasi_hari }} Hari
                                </span>
                            </td>
                            <td class="py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="text-center">
                                        <div class="small fw-semibold" style="color: #4a3b2c;">{{ $p->tanggal_pinjam->format('d M') }}</div>
                                        <div class="small text-muted">{{ $p->tanggal_pinjam->format('Y') }}</div>
                                    </div>
                                    <i class="bi bi-arrow-right" style="color: #8b5a2b;"></i>
                                    <div class="text-center">
                                        <div class="small fw-semibold" style="color: #4a3b2c;">{{ $p->tanggal_kembali_rencana->format('d M') }}</div>
                                        <div class="small text-muted">{{ $p->tanggal_kembali_rencana->format('Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">
                                @if($p->status == 'pending')
                                    <span class="badge py-2 px-3" style="background: #fff3cd; color: #856404; border-radius: 30px;">
                                        <i class="bi bi-hourglass-split me-1"></i> Menunggu
                                    </span>
                                @elseif($p->status == 'approved')
                                    <span class="badge py-2 px-3" style="background: #d4edda; color: #155724; border-radius: 30px;">
                                        <i class="bi bi-book me-1"></i> Dipinjam
                                    </span>
                                @elseif($p->status == 'returned')
                                    <span class="badge py-2 px-3" style="background: #d1ecf1; color: #0c5460; border-radius: 30px;">
                                        <i class="bi bi-check-circle me-1"></i> Kembali
                                    </span>
                                @else
                                    <span class="badge py-2 px-3" style="background: #f8d7da; color: #721c24; border-radius: 30px;">
                                        <i class="bi bi-x-circle me-1"></i> Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="text-end pe-4 py-3">
                                <div class="dropdown">
                                    <button class="btn d-flex align-items-center justify-content-center" 
                                            style="background: #f0e7d8; color: #8b5a2b; border-radius: 12px; width: 40px; height: 40px;"
                                            type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 rounded-3" style="min-width: 200px;">
                                        <li>
                                            <a class="dropdown-item rounded-2 mb-1 py-2" href="{{ route($routePrefix . 'peminjaman.show', $p) }}">
                                                <i class="bi bi-eye me-2" style="color: #8b5a2b;"></i> Detail
                                            </a>
                                        </li>
                                        
                                        @if($p->status == 'pending')
                                            <li>
                                                <form action="{{ route($routePrefix . 'peminjaman.approve', $p) }}" method="POST" class="approve-form">
                                                    @csrf
                                                    <button class="dropdown-item rounded-2 mb-1 py-2" style="color: #2b5f4e;">
                                                        <i class="bi bi-check-lg me-2" style="color: #2b5f4e;"></i> Setujui
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route($routePrefix . 'peminjaman.reject', $p) }}" method="POST" class="reject-form">
                                                    @csrf
                                                    <button class="dropdown-item rounded-2 py-2" style="color: #dc3545;">
                                                        <i class="bi bi-x-lg me-2" style="color: #dc3545;"></i> Tolak
                                                    </button>
                                                </form>
                                            </li>
                                        
                                        @elseif($p->status == 'approved')
                                            @if(auth()->user()->role === 'admin')
                                            <li>
                                                <a class="dropdown-item rounded-2 py-2" href="{{ route('admin.pengembalian.create', $p) }}" style="color: #8b5a2b;">
                                                    <i class="bi bi-arrow-return-left me-2" style="color: #8b5a2b;"></i> Proses Kembali
                                                </a>
                                            </li>
                                            @endif
                                        @endif
                                        
                                        @if($p->status == 'returned')
                                            <li>
                                                <span class="dropdown-item-text text-muted small py-2">
                                                    <i class="bi bi-check-circle-fill me-2 text-success"></i> Selesai
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center py-4">
                                    <div style="font-size: 80px; opacity: 0.2; margin-bottom: 20px;">
                                        📚
                                    </div>
                                    <i class="bi bi-journal-x" style="font-size: 3rem; color: #8b5a2b; opacity: 0.3; margin-bottom: 15px;"></i>
                                    <h5 class="fw-bold mb-2" style="color: #4a3b2c;">Belum Ada Transaksi Peminjaman</h5>
                                    <p class="text-muted mb-3" style="color: #8b7a6b;">Tidak ada data peminjaman buku untuk ditampilkan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($peminjamans->hasPages())
            <div class="card-footer bg-transparent border-0 p-4" style="border-top: 2px solid #f0e7d8;">
                <div class="d-flex justify-content-center">
                    <div class="pagination-wrapper" style="background: #f8f5f0; padding: 8px; border-radius: 50px;">
                        {{ $peminjamans->links() }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Card Footer -->
        <div class="card-footer bg-transparent border-0 p-4 text-end" style="border-top: 2px solid #f0e7d8;">
            <small class="text-muted">
                <i class="bi bi-info-circle me-1"></i>
                Total {{ $peminjamans->total() }} transaksi peminjaman buku
            </small>
        </div>
    </div>
</div>

<!-- CSS Tambahan -->
<style>
/* Font untuk judul */
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

/* Styling untuk dropdown */
.dropdown-item {
    transition: all 0.2s ease;
}

.dropdown-item:hover {
    background: #f0e7d8;
    transform: translateX(5px);
}

/* Styling untuk pagination */
.pagination {
    margin-bottom: 0;
    gap: 5px;
}

.page-link {
    border: none;
    padding: 8px 14px;
    color: #8b5a2b;
    background: transparent;
    border-radius: 30px !important;
    font-weight: 500;
    transition: all 0.2s ease;
}

.page-link:hover {
    background: #f0e7d8;
    color: #8b5a2b;
    transform: translateY(-2px);
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%);
    color: white;
    box-shadow: 0 5px 10px -3px rgba(139, 90, 43, 0.4);
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
        padding: 1rem;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 15px;
    }
    
    .bg-white.p-2 {
        flex-wrap: wrap;
    }
}
</style>
@endsection