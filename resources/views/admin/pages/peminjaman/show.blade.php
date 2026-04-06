@extends('layouts.app')

@section('title', 'Detail Peminjaman Buku')

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
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header dengan desain buku -->
            <div class="d-flex align-items-center gap-3 mb-4">
                <a href="{{ route($routePrefix . '.peminjaman.index') }}" 
                   class="btn rounded-circle shadow-sm d-flex align-items-center justify-content-center" 
                   style="width: 45px; height: 45px; background: white; color: #8b5a2b; border: 1px solid #e0d5c5;">
                    <i class="bi bi-arrow-left fs-5"></i>
                </a>
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <h3 class="fw-bold mb-0" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">Detail Transaksi #{{ $peminjaman->id }}</h3>
                        <i class="bi bi-journal-text" style="color: #8b5a2b;"></i>
                    </div>
                    <div class="small" style="color: #8b7a6b;">
                        <i class="bi bi-calendar3 me-1"></i>{{ $peminjaman->created_at->format('l, d F Y • H:i') }}
                    </div>
                </div>
            </div>

            <!-- Card Utama -->
            <div class="card border-0" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2); overflow: hidden;">
                <!-- Card Header -->
                <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-journal-bookmark-fill" style="color: #8b5a2b;"></i>
                        <span class="fw-medium" style="color: #6b5c4d;">Informasi Peminjaman Buku</span>
                    </div>
                </div>

                <div class="card-body p-5">
                    <!-- Status Badge dengan desain lebih menarik -->
                    <div class="text-center py-4 mb-4" style="background: #f8f5f0; border-radius: 20px;">
                        <div class="small mb-2" style="color: #6b5c4d;">Status Saat Ini</div>
                        @if($peminjaman->status == 'pending')
                            <div class="d-inline-block py-3 px-5" style="background: #fff3cd; color: #856404; border-radius: 50px; font-size: 1.2rem; font-weight: 600;">
                                <i class="bi bi-hourglass-split me-2"></i> Menunggu Persetujuan
                            </div>
                        @elseif($peminjaman->status == 'approved')
                            <div class="d-inline-block py-3 px-5" style="background: #d4edda; color: #155724; border-radius: 50px; font-size: 1.2rem; font-weight: 600;">
                                <i class="bi bi-book me-2"></i> Sedang Dipinjam
                            </div>
                        @elseif($peminjaman->status == 'returned')
                            <div class="d-inline-block py-3 px-5" style="background: #d1ecf1; color: #0c5460; border-radius: 50px; font-size: 1.2rem; font-weight: 600;">
                                <i class="bi bi-check-circle me-2"></i> Selesai (Dikembalikan)
                            </div>
                        @else
                            <div class="d-inline-block py-3 px-5" style="background: #f8d7da; color: #721c24; border-radius: 50px; font-size: 1.2rem; font-weight: 600;">
                                <i class="bi bi-x-circle me-2"></i> Ditolak
                            </div>
                        @endif
                    </div>

                    <!-- Grid Informasi -->
                    <div class="row g-4 mb-5">
                        <!-- Informasi Peminjam -->
                        <div class="col-md-6" style="border-right: 2px solid #f0e7d8;">
                            <h6 class="fw-bold mb-3" style="color: #4a3b2c;">
                                <i class="bi bi-person-circle me-2" style="color: #8b5a2b;"></i>Informasi Anggota
                            </h6>
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center justify-content-center" 
                                     style="width: 60px; height: 60px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 16px; color: white; font-size: 1.5rem; font-weight: 600;">
                                    {{ strtoupper(substr($peminjaman->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-bold fs-5" style="color: #4a3b2c;">{{ $peminjaman->user->name }}</div>
                                    <div style="color: #8b7a6b;">{{ $peminjaman->user->email }}</div>
                                    <div class="small mt-1">
                                        <span class="badge py-1 px-2" style="background: #f0e7d8; color: #8b5a2b;">
                                            <i class="bi bi-tag me-1"></i>Member
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Buku -->
                        <div class="col-md-6 ps-md-4">
                            <h6 class="fw-bold mb-3" style="color: #4a3b2c;">
                                <i class="bi bi-book me-2" style="color: #8b5a2b;"></i>Informasi Buku
                            </h6>
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center justify-content-center" 
                                     style="width: 60px; height: 60px; background: #f0e7d8; border-radius: 16px;">
                                    <i class="bi bi-journal-bookmark-fill fs-2" style="color: #8b5a2b;"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-5" style="color: #4a3b2c;">{{ $peminjaman->alat->nama_alat }}</div>
                                    <div style="color: #8b7a6b;">
                                        <i class="bi bi-upc-scan me-1"></i>ISBN: {{ $peminjaman->alat->kode_alat }}
                                    </div>
                                    <div class="small mt-1">
                                        <span class="badge py-1 px-2" style="background: #f0e7d8; color: #8b5a2b;">
                                            <i class="bi bi-layers me-1"></i>{{ $peminjaman->jumlah }} Eksemplar
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Divider dengan ornamen -->
                    <div class="d-flex align-items-center gap-3 my-4">
                        <div style="flex: 1; height: 2px; background: linear-gradient(to right, transparent, #8b5a2b, transparent);"></div>
                        <i class="bi bi-calendar-range" style="color: #8b5a2b;"></i>
                        <div style="flex: 1; height: 2px; background: linear-gradient(to right, transparent, #8b5a2b, transparent);"></div>
                    </div>

                    <!-- Rincian Waktu -->
                    <h6 class="fw-bold mb-3" style="color: #4a3b2c;">
                        <i class="bi bi-calendar-week me-2" style="color: #8b5a2b;"></i>Rincian Waktu
                    </h6>
                    <div class="row g-3 mb-5">
                        <div class="col-md-4">
                            <div class="p-4 text-center" style="background: #f8f5f0; border-radius: 20px;">
                                <div class="small mb-2" style="color: #8b7a6b;">Tanggal Pinjam</div>
                                <div class="fw-bold fs-5" style="color: #4a3b2c;">{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</div>
                                <div class="small text-muted">{{ $peminjaman->tanggal_pinjam->format('l') }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 text-center" style="background: #f8f5f0; border-radius: 20px;">
                                <div class="small mb-2" style="color: #8b7a6b;">Rencana Kembali</div>
                                <div class="fw-bold fs-5" style="color: #4a3b2c;">{{ $peminjaman->tanggal_kembali_rencana->format('d M Y') }}</div>
                                <div class="small text-muted">{{ $peminjaman->tanggal_kembali_rencana->format('l') }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 text-center" style="background: linear-gradient(145deg, #f0e7d8 0%, #e8d9c8 100%); border-radius: 20px;">
                                <div class="small mb-2" style="color: #6b5c4d;">Durasi</div>
                                <div class="fw-bold fs-4" style="color: #8b5a2b;">{{ $peminjaman->durasi_hari }} Hari</div>
                                <div class="small text-muted">Masa Peminjaman</div>
                            </div>
                        </div>
                    </div>

                    <!-- Keperluan -->
                    <div class="mb-5">
                        <h6 class="fw-bold mb-3" style="color: #4a3b2c;">
                            <i class="bi bi-card-text me-2" style="color: #8b5a2b;"></i>Keperluan
                        </h6>
                        <div class="p-4" style="background: #f8f5f0; border-radius: 20px; border-left: 4px solid #8b5a2b;">
                            <p class="mb-0 fst-italic" style="color: #4a3b2c; line-height: 1.6;">
                                "{{ $peminjaman->keperluan }}"
                            </p>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    @if($peminjaman->status === 'pending')
                        <div class="d-flex gap-3 justify-content-end pt-4" style="border-top: 2px solid #f0e7d8;">
                            <form action="{{ route($routePrefix . '.peminjaman.reject', $peminjaman) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn px-5 py-3" 
                                        style="background: #f0e7d8; color: #dc3545; border-radius: 16px; font-weight: 600;"
                                        onclick="return confirm('Tolak peminjaman ini?')">
                                    <i class="bi bi-x-lg me-2"></i> Tolak Request
                                </button>
                            </form>
                            <form action="{{ route($routePrefix . '.peminjaman.approve', $peminjaman) }}" method="POST" class="approve-form">
                                @csrf
                                <button type="submit" class="btn px-5 py-3" 
                                        style="background: linear-gradient(135deg, #2b5f4e 0%, #3b7b64 100%); color: white; border-radius: 16px; font-weight: 600; box-shadow: 0 10px 20px -5px rgba(43, 95, 78, 0.3);">
                                    <i class="bi bi-check-lg me-2"></i> Setujui Peminjaman
                                </button>
                            </form>
                        </div>

                    @elseif($peminjaman->status === 'approved')
                        <div class="pt-4" style="border-top: 2px solid #f0e7d8;">
                            <a href="{{ route($routePrefix . '.pengembalian.create', $peminjaman) }}" 
                               class="btn w-100 py-4 d-flex align-items-center justify-content-center"
                               style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 16px; font-weight: 600; font-size: 1.1rem;">
                                <i class="bi bi-arrow-return-left me-2"></i> Proses Pengembalian Buku
                            </a>
                        </div>

                    @elseif($peminjaman->status === 'returned' && $peminjaman->pengembalian)
                        <div class="pt-4" style="border-top: 2px solid #f0e7d8;">
                            <div class="alert d-flex justify-content-between align-items-center p-4" 
                                 style="background: #d4edda; color: #155724; border-radius: 16px; border-left: 4px solid #155724;">
                                <div>
                                    <strong><i class="bi bi-check-circle-fill me-2"></i>Peminjaman Selesai</strong>
                                    <div class="small mt-1">Buku telah dikembalikan. Lihat detail pengembalian untuk informasi lebih lanjut.</div>
                                </div>
                                <a href="{{ route($routePrefix . '.pengembalian.show', $peminjaman->pengembalian) }}" 
                                   class="btn px-4 py-2"
                                   style="background: white; color: #155724; border-radius: 12px; font-weight: 600;">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Card Footer -->
                <div class="card-footer bg-transparent border-0 p-4 text-end" style="border-top: 2px solid #f0e7d8;">
                    <small class="text-muted">
                        <i class="bi bi-printer me-1"></i>
                        <a href="#" style="color: #8b5a2b; text-decoration: none;">Cetak Bukti</a>
                    </small>
                </div>
            </div>
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

/* Styling untuk badge status */
.status-badge {
    transition: all 0.3s ease;
}

.status-badge:hover {
    transform: scale(1.05);
}

/* Animasi untuk ikon */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.bi-journal-text {
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
    
    .d-flex.gap-3 {
        flex-direction: column;
    }
    
    .col-md-6[style*="border-right"] {
        border-right: none !important;
        border-bottom: 2px solid #f0e7d8;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }
}
</style>
@endsection