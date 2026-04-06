@extends('layouts.app')

@section('title', 'Detail Pengembalian Buku')

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

@section('page-title', 'Detail Pengembalian Buku #' . $pengembalian->id)

@php
    $routePrefix = auth()->user()->role === 'petugas' ? 'petugas' : 'admin';
@endphp

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header dengan desain buku -->
            <div class="d-flex align-items-center gap-3 mb-4">
                <a href="{{ route($routePrefix . '.pengembalian.index') }}" 
                   class="btn rounded-circle shadow-sm d-flex align-items-center justify-content-center" 
                   style="width: 45px; height: 45px; background: white; color: #8b5a2b; border: 1px solid #e0d5c5;">
                    <i class="bi bi-arrow-left fs-5"></i>
                </a>
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <h3 class="fw-bold mb-0" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">Detail Pengembalian #{{ $pengembalian->id }}</h3>
                        <i class="bi bi-journal-check" style="color: #8b5a2b;"></i>
                    </div>
                    <p class="mb-0" style="color: #8b7a6b;">
                        <i class="bi bi-info-circle me-1"></i>Informasi lengkap transaksi pengembalian buku
                    </p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Kolom Kiri: Informasi Pengembalian -->
                <div class="col-md-8">
                    <div class="card border-0" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2); overflow: hidden;">
                        <!-- Card Header -->
                        <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-journal-text" style="color: #8b5a2b;"></i>
                                <span class="fw-medium" style="color: #6b5c4d;">Informasi Pengembalian Buku</span>
                            </div>
                        </div>

                        <div class="card-body p-5">
                            <!-- Status Badge -->
                            <div class="text-center py-4 mb-4" style="background: #f8f5f0; border-radius: 20px;">
                                @php
                                    $daysLate = $pengembalian->tanggal_kembali_aktual->gt($pengembalian->peminjaman->tanggal_kembali_rencana) 
                                        ? $pengembalian->tanggal_kembali_aktual->diffInDays($pengembalian->peminjaman->tanggal_kembali_rencana) 
                                        : 0;
                                @endphp
                                <div class="small mb-2" style="color: #6b5c4d;">Status Pengembalian</div>
                                @if($daysLate > 0)
                                    <div class="d-inline-block py-3 px-5" style="background: #f8d7da; color: #721c24; border-radius: 50px; font-size: 1.1rem; font-weight: 600;">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Terlambat {{ $daysLate }} Hari
                                    </div>
                                @else
                                    <div class="d-inline-block py-3 px-5" style="background: #d4edda; color: #155724; border-radius: 50px; font-size: 1.1rem; font-weight: 600;">
                                        <i class="bi bi-check-circle-fill me-2"></i> Tepat Waktu
                                    </div>
                                @endif
                            </div>

                            <!-- Grid Informasi -->
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <div class="p-4" style="background: #f8f5f0; border-radius: 20px;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div style="width: 50px; height: 50px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-upc-scan fs-4" style="color: #8b5a2b;"></i>
                                            </div>
                                            <div>
                                                <div class="small text-muted">ID Pengembalian</div>
                                                <div class="fw-bold fs-5" style="color: #4a3b2c;">#{{ $pengembalian->id }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-4" style="background: #f8f5f0; border-radius: 20px;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div style="width: 50px; height: 50px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-journal-bookmark-fill fs-4" style="color: #8b5a2b;"></i>
                                            </div>
                                            <div>
                                                <div class="small text-muted">ID Peminjaman</div>
                                                <a href="{{ route($routePrefix . '.peminjaman.show', $pengembalian->peminjaman) }}" 
                                                   class="fw-bold fs-5 text-decoration-none" style="color: #8b5a2b;">
                                                    #{{ $pengembalian->peminjaman_id }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Divider -->
                            <div class="d-flex align-items-center gap-3 my-4">
                                <div style="flex: 1; height: 2px; background: linear-gradient(to right, transparent, #8b5a2b, transparent);"></div>
                                <i class="bi bi-calendar-range" style="color: #8b5a2b;"></i>
                                <div style="flex: 1; height: 2px; background: linear-gradient(to right, transparent, #8b5a2b, transparent);"></div>
                            </div>

                            <!-- Tanggal Kembali -->
                            <div class="row g-3 mb-5">
                                <div class="col-md-6">
                                    <div class="p-4 text-center" style="background: #f8f5f0; border-radius: 20px;">
                                        <div class="small mb-2" style="color: #8b7a6b;">Rencana Kembali</div>
                                        <div class="fw-bold fs-5" style="color: #4a3b2c;">{{ $pengembalian->peminjaman->tanggal_kembali_rencana->format('d M Y') }}</div>
                                        <div class="small text-muted">{{ $pengembalian->peminjaman->tanggal_kembali_rencana->format('l') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-4 text-center" style="background: linear-gradient(145deg, #f0e7d8 0%, #e8d9c8 100%); border-radius: 20px;">
                                        <div class="small mb-2" style="color: #6b5c4d;">Aktual Kembali</div>
                                        <div class="fw-bold fs-5" style="color: #8b5a2b;">{{ $pengembalian->tanggal_kembali_aktual->format('d M Y') }}</div>
                                        <div class="small text-muted">{{ $pengembalian->tanggal_kembali_aktual->format('l') }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kondisi Buku -->
                            <div class="mb-4">
                                <label class="form-label fw-bold mb-3" style="color: #4a3b2c;">
                                    <i class="bi bi-clipboard-check me-2" style="color: #8b5a2b;"></i>Kondisi Buku
                                </label>
                                @php
                                    $kondisiColors = [
                                        'baik' => ['bg' => '#d4edda', 'text' => '#155724', 'icon' => 'bi-check-circle-fill'],
                                        'rusak_ringan' => ['bg' => '#fff3cd', 'text' => '#856404', 'icon' => 'bi-exclamation-triangle-fill'],
                                        'rusak_berat' => ['bg' => '#f8d7da', 'text' => '#721c24', 'icon' => 'bi-x-circle-fill']
                                    ];
                                    $kondisiLabels = [
                                        'baik' => 'Baik (Layak Baca)',
                                        'rusak_ringan' => 'Rusak Ringan (Sobek kecil/coretan)',
                                        'rusak_berat' => 'Rusak Berat (Halaman hilang/rusak parah)'
                                    ];
                                    $color = $kondisiColors[$pengembalian->kondisi_alat] ?? ['bg' => '#e2e3e5', 'text' => '#383d41', 'icon' => 'bi-question-circle'];
                                @endphp
                                <div class="p-4 rounded-3" style="background: {{ $color['bg'] }}; color: {{ $color['text'] }};">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="bi {{ $color['icon'] }} fs-2"></i>
                                        <div>
                                            <span class="fw-bold fs-5">{{ $kondisiLabels[$pengembalian->kondisi_alat] ?? $pengembalian->kondisi_alat }}</span>
                                            @if($pengembalian->keterangan)
                                                <p class="mb-0 mt-2 small">{{ $pengembalian->keterangan }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Keterangan (jika ada) -->
                            @if($pengembalian->keterangan)
                                <div class="mb-4">
                                    <label class="form-label fw-bold mb-2" style="color: #4a3b2c;">
                                        <i class="bi bi-chat-left-text me-2" style="color: #8b5a2b;"></i>Keterangan
                                    </label>
                                    <div class="p-4" style="background: #f8f5f0; border-radius: 16px; border-left: 4px solid #8b5a2b;">
                                        {{ $pengembalian->keterangan }}
                                    </div>
                                </div>
                            @endif

                            <!-- Diproses oleh -->
                            <div class="mb-4">
                                <label class="form-label fw-bold mb-2" style="color: #4a3b2c;">
                                    <i class="bi bi-person-badge me-2" style="color: #8b5a2b;"></i>Diproses oleh
                                </label>
                                <div class="d-flex align-items-center gap-3 p-4" style="background: #f8f5f0; border-radius: 16px;">
                                    <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 1.2rem;">
                                        {{ strtoupper(substr($pengembalian->processor->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold" style="color: #4a3b2c;">{{ $pengembalian->processor->name }}</div>
                                        <div class="small text-muted">{{ $pengembalian->created_at->format('d F Y H:i') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Rincian Biaya & Info Peminjaman -->
                <div class="col-md-4">
                    <!-- Card Rincian Biaya -->
                    <div class="card border-0 mb-4" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1); overflow: hidden;">
                        <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
                            <h5 class="mb-0 fw-bold" style="color: #4a3b2c;">
                                <i class="bi bi-calculator me-2" style="color: #8b5a2b;"></i>Rincian Biaya
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center py-2">
                                    <span style="color: #6b5c4d;">Sewa Buku</span>
                                    <span class="fw-bold" style="color: #4a3b2c;">Rp {{ number_format($pengembalian->peminjaman->total_biaya, 0, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center py-2">
                                    <span style="color: #6b5c4d;">Denda</span>
                                    <span class="fw-bold {{ $pengembalian->denda > 0 ? 'text-danger' : 'text-success' }}">
                                        Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                                    </span>
                                </div>
                                <hr style="border-color: #f0e7d8;">
                                <div class="d-flex justify-content-between align-items-center py-2">
                                    <span class="fw-bold" style="color: #4a3b2c;">TOTAL</span>
                                    <span class="fw-bold fs-5" style="color: #8b5a2b;">Rp {{ number_format($pengembalian->peminjaman->total_biaya + $pengembalian->denda, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            @php
                                $isLunas = $pengembalian->status_denda === 'paid' && $pengembalian->peminjaman->payment_status === 'paid';
                            @endphp
                            
                            @if($isLunas)
                                <div class="alert d-flex align-items-center p-3 mb-0" style="background: #d4edda; color: #155724; border-radius: 12px;">
                                    <i class="bi bi-check-circle-fill me-3 fs-4"></i>
                                    <div>
                                        <strong class="d-block">LUNAS</strong>
                                        <span class="small">Semua tagihan telah dibayar.</span>
                                    </div>
                                </div>
                            @else
                                <div class="alert d-flex align-items-center p-3" style="background: #fff3cd; color: #856404; border-radius: 12px;">
                                    <i class="bi bi-exclamation-triangle-fill me-3 fs-4"></i>
                                    <div>
                                        <strong class="d-block">BELUM LUNAS</strong>
                                        <span class="small">Harap tagih pembayaran ke anggota.</span>
                                    </div>
                                </div>
                                <form action="{{ route($routePrefix . '.pengembalian.markPaid', $pengembalian) }}" method="POST" class="mt-3 payment-form">
                                    @csrf
                                    <button type="submit" class="btn w-100 py-3" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 12px; font-weight: 600;">
                                        <i class="bi bi-wallet2 me-2"></i> Terima Pembayaran
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <!-- Card Info Peminjaman -->
                    <div class="card border-0 mb-4" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1); overflow: hidden;">
                        <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
                            <h5 class="mb-0 fw-bold" style="color: #4a3b2c;">
                                <i class="bi bi-info-circle me-2" style="color: #8b5a2b;"></i>Info Peminjaman
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <div class="small text-muted mb-1">Anggota</div>
                                <div class="fw-bold" style="color: #4a3b2c;">{{ $pengembalian->peminjaman->user->name }}</div>
                            </div>
                            <div class="mb-3">
                                <div class="small text-muted mb-1">Judul Buku</div>
                                <div class="fw-bold" style="color: #4a3b2c;">{{ $pengembalian->peminjaman->alat->nama_alat }}</div>
                            </div>
                            <div class="mb-3">
                                <div class="small text-muted mb-1">ISBN</div>
                                <div class="fw-bold" style="color: #4a3b2c;">{{ $pengembalian->peminjaman->alat->kode_alat }}</div>
                            </div>
                            <div class="mb-3">
                                <div class="small text-muted mb-1">Kategori</div>
                                <span class="badge py-2 px-3" style="background: #f0e7d8; color: #8b5a2b;">
                                    {{ $pengembalian->peminjaman->alat->kategori->nama_kategori }}
                                </span>
                            </div>
                            <div class="mb-3">
                                <div class="small text-muted mb-1">Jumlah</div>
                                <div class="fw-bold" style="color: #4a3b2c;">{{ $pengembalian->peminjaman->jumlah }} Eksemplar</div>
                            </div>
                            <div>
                                <div class="small text-muted mb-1">Keperluan</div>
                                <div class="p-3" style="background: #f8f5f0; border-radius: 12px;">{{ $pengembalian->peminjaman->keperluan }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Kembali -->
                    <a href="{{ route($routePrefix . '.pengembalian.index') }}" 
                       class="btn w-100 py-3 d-flex align-items-center justify-content-center"
                       style="background: #f0e7d8; color: #8b5a2b; border-radius: 16px; font-weight: 600;">
                        <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar
                    </a>
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

/* Animasi untuk ikon */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.bi-journal-check {
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
    
    .btn {
        width: 100%;
    }
}
</style>
@endsection