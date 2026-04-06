@extends('layouts.app')

@section('title', 'Daftar Pengembalian Buku')

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

@section('page-title', 'Daftar Pengembalian Buku')

@php
    $routePrefix = auth()->user()->role === 'petugas' ? 'petugas' : 'admin';
@endphp

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <!-- Header dengan desain buku -->
    <div class="d-flex align-items-center gap-3 mb-4">
        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-journal-arrow-down fs-3 text-white"></i>
        </div>
        <div>
            <h2 class="fw-bold mb-1" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">Riwayat Pengembalian Buku</h2>
            <p class="mb-0" style="color: #8b7a6b;">
                <i class="bi bi-clock-history me-1"></i>Daftar semua transaksi pengembalian buku dari anggota
            </p>
        </div>
    </div>

    <!-- Card Utama -->
    <div class="card border-0" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2); overflow: hidden;">
        <!-- Card Header -->
        <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-journal-text" style="color: #8b5a2b;"></i>
                <span class="fw-medium" style="color: #6b5c4d;">Riwayat Pengembalian Buku</span>
                <span class="ms-auto badge py-2 px-3" style="background: #f0e7d8; color: #8b5a2b;">
                    Total: {{ $pengembalians->total() }} Pengembalian
                </span>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0" style="border-collapse: separate; border-spacing: 0;">
                    <thead style="background: #f8f5f0;">
                        <tr>
                            <th class="ps-4 py-3" style="color: #6b5c4d; font-weight: 600;">ID</th>
                            <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Peminjaman</th>
                            <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Anggota</th>
                            <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Judul Buku</th>
                            <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Tanggal Kembali</th>
                            <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Kondisi</th>
                            <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Denda</th>
                            <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Petugas</th>
                            <th class="text-end pe-4 py-3" style="color: #6b5c4d; font-weight: 600;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengembalians as $p)
                            <tr style="border-bottom: 1px solid #f0e7d8;">
                                <td class="ps-4 py-3">
                                    <span class="fw-bold" style="color: #4a3b2c;">#{{ $p->id }}</span>
                                </td>
                                <td class="py-3">
                                    <span class="badge py-2 px-3" style="background: #f0e7d8; color: #8b5a2b; border-radius: 30px;">
                                        #{{ $p->peminjaman_id }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center justify-content-center me-2" 
                                             style="width: 35px; height: 35px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 10px; color: white; font-weight: 600; font-size: 0.9rem;">
                                            {{ strtoupper(substr($p->peminjaman->user->name, 0, 1)) }}
                                        </div>
                                        <span style="color: #4a3b2c;">{{ $p->peminjaman->user->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-book me-2" style="color: #8b5a2b;"></i>
                                        <span style="color: #4a3b2c;">{{ $p->peminjaman->alat->nama_alat }}</span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span style="color: #4a3b2c;">{{ $p->tanggal_kembali_aktual->format('d/m/Y') }}</span>
                                    <div class="small text-muted">{{ $p->tanggal_kembali_aktual->format('l') }}</div>
                                </td>
                                <td class="py-3">
                                    @php
                                        $kondisiColors = [
                                            'baik' => ['bg' => '#d4edda', 'text' => '#155724'],
                                            'rusak_ringan' => ['bg' => '#fff3cd', 'text' => '#856404'],
                                            'rusak_berat' => ['bg' => '#f8d7da', 'text' => '#721c24']
                                        ];
                                        $color = $kondisiColors[$p->kondisi_alat] ?? ['bg' => '#e2e3e5', 'text' => '#383d41'];
                                        $kondisiLabels = [
                                            'baik' => 'Baik',
                                            'rusak_ringan' => 'Rusak Ringan',
                                            'rusak_berat' => 'Rusak Berat'
                                        ];
                                    @endphp
                                    <span class="badge py-2 px-3" style="background: {{ $color['bg'] }}; color: {{ $color['text'] }}; border-radius: 30px;">
                                        <i class="bi bi-clipboard-check me-1"></i>
                                        {{ $kondisiLabels[$p->kondisi_alat] ?? $p->kondisi_alat }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <span class="fw-bold {{ $p->denda > 0 ? 'text-danger' : 'text-success' }}">
                                        @if($p->denda > 0)
                                            <i class="bi bi-exclamation-triangle-fill me-1" style="font-size: 0.8rem;"></i>
                                        @else
                                            <i class="bi bi-check-circle-fill me-1" style="font-size: 0.8rem;"></i>
                                        @endif
                                        {{ $p->denda_formatted }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2" style="width: 30px; height: 30px; background: #f0e7d8; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <span style="color: #8b5a2b; font-size: 0.8rem; font-weight: 600;">{{ strtoupper(substr($p->processor->name, 0, 1)) }}</span>
                                        </div>
                                        <span style="color: #6b5c4d;">{{ $p->processor->name }}</span>
                                    </div>
                                </td>
                                <td class="text-end pe-4 py-3">
                                    <a href="{{ route($routePrefix . '.pengembalian.show', $p) }}" 
                                       class="btn d-inline-flex align-items-center justify-content-center"
                                       style="background: #f0e7d8; color: #8b5a2b; border-radius: 12px; padding: 8px 20px; font-weight: 500;"
                                       title="Lihat Detail">
                                        <i class="bi bi-eye me-1"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center py-4">
                                        <div style="font-size: 80px; opacity: 0.2; margin-bottom: 20px;">
                                            📚
                                        </div>
                                        <i class="bi bi-journal-x" style="font-size: 3rem; color: #8b5a2b; opacity: 0.3; margin-bottom: 15px;"></i>
                                        <h5 class="fw-bold mb-2" style="color: #4a3b2c;">Belum Ada Pengembalian</h5>
                                        <p class="text-muted mb-3" style="color: #8b7a6b;">Tidak ada riwayat pengembalian buku untuk ditampilkan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($pengembalians->hasPages())
            <div class="card-footer bg-transparent border-0 p-4" style="border-top: 2px solid #f0e7d8;">
                <div class="d-flex justify-content-center">
                    <div class="pagination-wrapper" style="background: #f8f5f0; padding: 8px; border-radius: 50px;">
                        {{ $pengembalians->links() }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Card Footer -->
        <div class="card-footer bg-transparent border-0 p-4 text-end" style="border-top: 2px solid #f0e7d8;">
            <small class="text-muted">
                <i class="bi bi-info-circle me-1"></i>
                Total {{ $pengembalians->total() }} transaksi pengembalian buku
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

/* Styling untuk tombol */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px -5px rgba(0,0,0,0.2);
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

/* Animasi untuk ikon */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.bi-journal-arrow-down {
    animation: float 3s ease-in-out infinite;
    display: inline-block;
}

/* Responsive */
@media (max-width: 768px) {
    .table {
        font-size: 0.85rem;
    }
    
    .badge {
        font-size: 0.7rem;
    }
    
    .btn {
        padding: 6px 12px !important;
    }
}
</style>
@endsection