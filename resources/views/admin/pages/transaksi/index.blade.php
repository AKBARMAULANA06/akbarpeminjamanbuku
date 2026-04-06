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

@section('page-title', 'Transaksi Peminjaman Buku')

@php
    $routePrefix = auth()->user()->role === 'petugas' ? 'petugas' : 'admin';
@endphp

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <!-- Header dengan desain buku -->
    <div class="d-flex align-items-center gap-3 mb-4">
        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-journal-bookmark-fill fs-3 text-white"></i>
        </div>
        <div>
            <h2 class="fw-bold mb-1" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">Transaksi Peminjaman Buku</h2>
            <p class="mb-0" style="color: #8b7a6b;">
                <i class="bi bi-receipt me-1"></i>Monitor semua transaksi peminjaman dan pembayaran
            </p>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 h-100" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 60px; height: 60px; background: linear-gradient(145deg, #f0e7d8 0%, #e8d9c8 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-journal-text fs-2" style="color: #8b5a2b;"></i>
                        </div>
                        <div>
                            <span class="small text-muted text-uppercase">Total Transaksi</span>
                            <h3 class="fw-bold mb-0" style="color: #4a3b2c;">{{ $totalTransaksi }}</h3>
                            <span class="small text-muted">Transaksi peminjaman</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 h-100" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 60px; height: 60px; background: linear-gradient(145deg, #f0e7d8 0%, #e8d9c8 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-cash-stack fs-2" style="color: #2b5f4e;"></i>
                        </div>
                        <div>
                            <span class="small text-muted text-uppercase">Total Pendapatan</span>
                            <h3 class="fw-bold mb-0" style="color: #2b5f4e;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                            <span class="small text-muted">Dari denda & sewa</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 h-100" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 60px; height: 60px; background: linear-gradient(145deg, #f0e7d8 0%, #e8d9c8 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-clock-history fs-2" style="color: #b8860b;"></i>
                        </div>
                        <div>
                            <span class="small text-muted text-uppercase">Menunggu Bayar</span>
                            <h3 class="fw-bold mb-0" style="color: #b8860b;">{{ $menungguPembayaran }}</h3>
                            <span class="small text-muted">Transaksi belum lunas</span>
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
                <span class="fw-medium" style="color: #6b5c4d;">Daftar Transaksi Peminjaman Buku</span>
                <span class="ms-auto badge py-2 px-3" style="background: #f0e7d8; color: #8b5a2b;">
                    Total: {{ $transaksi->total() }} Transaksi
                </span>
            </div>
        </div>

        <div class="card-body p-4">
            <!-- Filter Form -->
            <form method="GET" class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label small fw-medium" style="color: #4a3b2c;">
                        <i class="bi bi-person me-1" style="color: #8b5a2b;"></i>Filter Anggota
                    </label>
                    <select name="user_id" class="form-select" style="padding: 10px 16px; border-radius: 12px; border: 1.5px solid #e0d5c5;">
                        <option value="">Semua Anggota</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-medium" style="color: #4a3b2c;">
                        <i class="bi bi-cash me-1" style="color: #8b5a2b;"></i>Status Pembayaran
                    </label>
                    <select name="payment_status" class="form-select" style="padding: 10px 16px; border-radius: 12px; border: 1.5px solid #e0d5c5;">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-medium" style="color: #4a3b2c;">&nbsp;</label>
                    <button type="submit" class="btn w-100 py-2" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 12px; font-weight: 500;">
                        <i class="bi bi-filter me-2"></i>Terapkan Filter
                    </button>
                </div>
            </form>

            @if($transaksi->count() > 0)
                <div class="table-responsive">
                    <table class="table align-middle" style="border-collapse: separate; border-spacing: 0;">
                        <thead style="background: #f8f5f0;">
                            <tr>
                                <th class="ps-4 py-3" style="color: #6b5c4d; font-weight: 600;">ID</th>
                                <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Anggota</th>
                                <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Judul Buku</th>
                                <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Tgl Pinjam</th>
                                <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Durasi</th>
                                <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Total Biaya</th>
                                <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Pembayaran</th>
                                <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Status</th>
                                <th class="text-end pe-4 py-3" style="color: #6b5c4d; font-weight: 600;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi as $item)
                            <tr style="border-bottom: 1px solid #f0e7d8;">
                                <td class="ps-4 py-3">
                                    <span class="fw-bold" style="color: #4a3b2c;">#{{ $item->id }}</span>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="d-flex align-items-center justify-content-center" 
                                             style="width: 40px; height: 40px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 10px; color: white; font-weight: 600;">
                                            {{ strtoupper(substr($item->user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold" style="color: #4a3b2c;">{{ $item->user->name }}</div>
                                            <small style="color: #8b7a6b;">{{ $item->user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div style="color: #4a3b2c;">{{ $item->alat->nama_alat }}</div>
                                    <small style="color: #8b7a6b;">
                                        <i class="bi bi-tag me-1"></i>{{ $item->alat->kategori->nama_kategori }}
                                    </small>
                                </td>
                                <td class="py-3">
                                    <span style="color: #4a3b2c;">{{ $item->tanggal_pinjam->format('d/m/Y') }}</span>
                                </td>
                                <td class="py-3">
                                    <span class="badge py-2 px-3" style="background: #f0e7d8; color: #8b5a2b; border-radius: 30px;">
                                        <i class="bi bi-calendar-week me-1"></i>{{ $item->durasi_hari ?? 0 }} Hari
                                    </span>
                                </td>
                                <td class="py-3">
                                    <span class="fw-bold" style="color: #2b5f4e;">Rp {{ number_format($item->total_biaya ?? 0, 0, ',', '.') }}</span>
                                </td>
                                <td class="py-3">
                                    @if($item->payment_status === 'paid')
                                        <span class="badge py-2 px-3" style="background: #d4edda; color: #155724; border-radius: 30px;">
                                            <i class="bi bi-check-circle me-1"></i> Lunas
                                        </span>
                                        @if($item->paid_at)
                                            <div class="small text-muted mt-1">{{ $item->paid_at->format('d/m/Y H:i') }}</div>
                                        @endif
                                    @else
                                        <span class="badge py-2 px-3" style="background: #fff3cd; color: #856404; border-radius: 30px;">
                                            <i class="bi bi-clock me-1"></i> Belum Lunas
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <span class="badge py-2 px-3" style="background: {{ $item->status === 'pending' ? '#fff3cd' : ($item->status === 'approved' ? '#d4edda' : ($item->status === 'returned' ? '#d1ecf1' : '#f8d7da')) }}; color: {{ $item->status === 'pending' ? '#856404' : ($item->status === 'approved' ? '#155724' : ($item->status === 'returned' ? '#0c5460' : '#721c24')) }}; border-radius: 30px;">
                                        {{ $item->status_text }}
                                    </span>
                                </td>
                                <td class="text-end pe-4 py-3">
                                    <a href="{{ route($routePrefix . '.peminjaman.show', $item) }}" 
                                       class="btn d-inline-flex align-items-center justify-content-center"
                                       style="background: #f0e7d8; color: #8b5a2b; border-radius: 12px; padding: 8px 16px;"
                                       title="Lihat Detail">
                                        <i class="bi bi-eye me-1"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 d-flex justify-content-center">
                    <div class="pagination-wrapper" style="background: #f8f5f0; padding: 8px; border-radius: 50px;">
                        {{ $transaksi->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <div style="font-size: 80px; opacity: 0.2; margin-bottom: 20px;">
                        📚
                    </div>
                    <i class="bi bi-journal-x" style="font-size: 3rem; color: #8b5a2b; opacity: 0.3; margin-bottom: 15px;"></i>
                    <h5 class="fw-bold mb-2" style="color: #4a3b2c;">Belum Ada Transaksi</h5>
                    <p class="text-muted mb-3" style="color: #8b7a6b;">Tidak ada data transaksi peminjaman buku</p>
                </div>
            @endif
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

/* Animasi untuk ikon */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.bi-journal-bookmark-fill {
    animation: float 3s ease-in-out infinite;
    display: inline-block;
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
    
    .table {
        font-size: 0.85rem;
    }
    
    .btn {
        width: 100%;
    }
}
</style>
@endsection