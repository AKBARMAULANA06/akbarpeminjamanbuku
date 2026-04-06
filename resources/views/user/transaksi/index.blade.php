@extends('layouts.app')

@section('sidebar')
    @include('user.components.sidebar')
@endsection

@section('navigation')
    @include('layouts.navigation')
@endsection

@section('page-title', 'Riwayat Peminjaman Buku')

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <!-- Header dengan desain buku -->
    <div class="d-flex align-items-center gap-3 mb-4">
        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-journal-text fs-3 text-white"></i>
        </div>
        <div>
            <h2 class="fw-bold mb-1" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">Riwayat Peminjaman Buku</h2>
            <p class="mb-0" style="color: #8b7a6b;">
                <i class="bi bi-clock-history me-1"></i>Daftar semua transaksi peminjaman buku Anda
            </p>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 h-100" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 50px; height: 50px; background: #f0e7d8; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-journal-bookmark-fill fs-4" style="color: #8b5a2b;"></i>
                        </div>
                        <div>
                            <span class="small text-muted">Total Transaksi</span>
                            <h3 class="fw-bold mb-0" style="color: #4a3b2c;">{{ $totalTransaksi }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 h-100" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 50px; height: 50px; background: #f0e7d8; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-cash-stack fs-4" style="color: #2b5f4e;"></i>
                        </div>
                        <div>
                            <span class="small text-muted">Total Denda</span>
                            <h3 class="fw-bold mb-0" style="color: #2b5f4e;">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 h-100" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 50px; height: 50px; background: #f0e7d8; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-book fs-4" style="color: #8b5a2b;"></i>
                        </div>
                        <div>
                            <span class="small text-muted">Sedang Dipinjam</span>
                            <h3 class="fw-bold mb-0" style="color: #8b5a2b;">{{ $transaksiAktif }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Riwayat -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2); overflow: hidden;">
                <!-- Card Header -->
                <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-journal-text" style="color: #8b5a2b;"></i>
                        <span class="fw-medium" style="color: #6b5c4d;">Riwayat Peminjaman Buku</span>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if($transaksi->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-middle" style="border-collapse: separate; border-spacing: 0;">
                                <thead style="background: #f8f5f0;">
                                    <tr>
                                        <th class="ps-4 py-3" style="color: #6b5c4d; font-weight: 600;">ID</th>
                                        <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Judul Buku</th>
                                        <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Tgl Pinjam</th>
                                        <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Tgl Kembali</th>
                                        <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Durasi</th>
                                        <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Total Denda</th>
                                        <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Status</th>
                                        <th class="text-end pe-4 py-3" style="color: #6b5c4d; font-weight: 600;">Pembayaran</th>
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
                                                <div style="width: 40px; height: 40px; background: #f0e7d8; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="bi bi-journal-bookmark-fill" style="color: #8b5a2b;"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold" style="color: #4a3b2c;">{{ $item->alat->nama_alat }}</div>
                                                    <small class="text-muted">{{ $item->alat->kategori->nama_kategori }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <span style="color: #6b5c4d;">{{ $item->tanggal_pinjam->format('d/m/Y') }}</span>
                                        </td>
                                        <td class="py-3">
                                            <span style="color: #6b5c4d;">{{ $item->tanggal_kembali_rencana->format('d/m/Y') }}</span>
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
                                            @php
                                                $statusColors = [
                                                    'pending' => ['bg' => '#fff3cd', 'text' => '#856404'],
                                                    'approved' => ['bg' => '#d4edda', 'text' => '#155724'],
                                                    'returned' => ['bg' => '#d1ecf1', 'text' => '#0c5460'],
                                                    'rejected' => ['bg' => '#f8d7da', 'text' => '#721c24']
                                                ];
                                                $statusLabels = [
                                                    'pending' => 'Menunggu',
                                                    'approved' => 'Dipinjam',
                                                    'returned' => 'Selesai',
                                                    'rejected' => 'Ditolak'
                                                ];
                                                $color = $statusColors[$item->status] ?? ['bg' => '#e2e3e5', 'text' => '#383d41'];
                                            @endphp
                                            <span class="badge py-2 px-3" style="background: {{ $color['bg'] }}; color: {{ $color['text'] }}; border-radius: 30px;">
                                                <i class="bi 
                                                    @if($item->status == 'pending') bi-hourglass-split
                                                    @elseif($item->status == 'approved') bi-book
                                                    @elseif($item->status == 'returned') bi-check-circle
                                                    @else bi-x-circle
                                                    @endif me-1">
                                                </i>
                                                {{ $statusLabels[$item->status] ?? $item->status }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-4 py-3">
                                            @if($item->payment_status === 'paid')
                                                <span class="badge py-2 px-3" style="background: #d4edda; color: #155724; border-radius: 30px;">
                                                    <i class="bi bi-check-circle-fill me-1"></i> Lunas
                                                </span>
                                            @else
                                                <span class="badge py-2 px-3" style="background: #fff3cd; color: #856404; border-radius: 30px;">
                                                    <i class="bi bi-clock me-1"></i> Belum Bayar
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        @if($transaksi->hasPages())
                        <div class="p-4 d-flex justify-content-center" style="border-top: 2px solid #f0e7d8;">
                            <div class="pagination-wrapper" style="background: #f8f5f0; padding: 8px; border-radius: 50px;">
                                {{ $transaksi->links() }}
                            </div>
                        </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <div style="font-size: 80px; opacity: 0.2; margin-bottom: 20px;">
                                📚
                            </div>
                            <i class="bi bi-journal-x" style="font-size: 3rem; color: #8b5a2b; opacity: 0.3; margin-bottom: 15px;"></i>
                            <p class="text-muted mb-3" style="color: #8b7a6b;">Belum ada transaksi peminjaman buku</p>
                            <a href="{{ route('user.peminjaman.create') }}" class="btn d-inline-flex align-items-center px-4 py-2" 
                               style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 50px; font-weight: 500;">
                                <i class="bi bi-book-plus me-2"></i> Pinjam Buku Sekarang
                            </a>
                        </div>
                    @endif
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
    
    .table {
        font-size: 0.85rem;
    }
}
</style>
@endsection