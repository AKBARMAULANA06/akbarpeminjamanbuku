@extends('layouts.app')

@section('title', 'Data Buku')

@section('sidebar')
    @include('petugas.components.sidebar')
@endsection

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <!-- Header dengan desain buku -->
    <div class="d-flex align-items-center gap-3 mb-4">
        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(139, 90, 43, 0.3);">
            <i class="bi bi-book-half fs-2 text-white"></i>
        </div>
        <div>
            <h2 class="fw-bold mb-1" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">Data Buku</h2>
            <p class="mb-0" style="color: #8b7a6b;">Kelola koleksi buku perpustakaan</p>
        </div>
    </div>

    <!-- Tampilkan success message jika ada -->
    @if(session('success'))
        <div class="alert alert-success mb-4" style="border-radius: 16px; background: #d4edda; color: #155724; border: none;">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Tampilkan error message jika ada -->
    @if(session('error'))
        <div class="alert alert-danger mb-4" style="border-radius: 16px; background: #f8d7da; color: #721c24; border: none;">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="card border-0" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2); overflow: hidden;">
        <!-- Card Header -->
        <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-journal-bookmark-fill" style="color: #8b5a2b;"></i>
                    <span class="fw-medium" style="color: #6b5c4d;">Daftar Koleksi Buku</span>
                    <span class="badge" style="background: #8b5a2b; border-radius: 20px;">{{ $alats->total() }} Buku</span>
                </div>
                <div class="d-flex gap-2">
                    <!-- Form Pencarian -->
                    <form action="{{ route('petugas.alat.index') }}" method="GET" class="d-flex gap-2">
                        <div class="input-group" style="border-radius: 16px; overflow: hidden;">
                            <input type="text" name="search" class="form-control" placeholder="Cari judul atau kode buku..." 
                                   value="{{ request('search') }}" style="border: 1.5px solid #e0d5c5; padding: 10px 16px;">
                            <button class="btn" type="submit" style="background: #8b5a2b; color: white; border: none;">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                        @if(request('search'))
                            <a href="{{ route('petugas.alat.index') }}" class="btn" style="background: #f0e7d8; color: #8b5a2b; border-radius: 16px;">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </form>
                    <!-- Tombol Tambah Buku -->
                    <a href="{{ route('petugas.alat.create') }}" class="btn" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 16px; padding: 10px 20px;">
                        <i class="bi bi-plus-lg me-2"></i>Tambah Buku
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-family: 'Inter', sans-serif;">
                    <thead style="background: #faf7f2;">
                        <tr>
                            <th style="padding: 16px; color: #4a3b2c; font-weight: 600; border-bottom: 2px solid #f0e7d8;">
                                <i class="bi bi-upc-scan me-2"></i>Kode Buku
                            </th>
                            <th style="padding: 16px; color: #4a3b2c; font-weight: 600; border-bottom: 2px solid #f0e7d8;">
                                <i class="bi bi-book me-2"></i>Judul Buku
                            </th>
                            <th style="padding: 16px; color: #4a3b2c; font-weight: 600; border-bottom: 2px solid #f0e7d8;">
                                <i class="bi bi-tag me-2"></i>Kategori
                            </th>
                            <th style="padding: 16px; color: #4a3b2c; font-weight: 600; border-bottom: 2px solid #f0e7d8;">
                                <i class="bi bi-layers me-2"></i>Stok
                            </th>
                            <th style="padding: 16px; color: #4a3b2c; font-weight: 600; border-bottom: 2px solid #f0e7d8;">
                                <i class="bi bi-cash me-2"></i>Denda/Hari
                            </th>
                            <th style="padding: 16px; color: #4a3b2c; font-weight: 600; border-bottom: 2px solid #f0e7d8;">
                                <i class="bi bi-clipboard-check me-2"></i>Kondisi
                            </th>
                            <th style="padding: 16px; color: #4a3b2c; font-weight: 600; border-bottom: 2px solid #f0e7d8; text-align: center;">
                                <i class="bi bi-gear me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alats as $alat)
                        <tr style="border-bottom: 1px solid #f0e7d8;">
                            <td style="padding: 16px;">
                                <span class="fw-medium" style="color: #8b5a2b; font-family: monospace;">{{ $alat->kode_alat }}</span>
                            </td>
                            <td style="padding: 16px;">
                                <div class="d-flex align-items-center gap-3">
                                    @if($alat->foto)
                                        <img src="{{ asset('storage/' . $alat->foto) }}" alt="Cover" 
                                             style="width: 40px; height: 50px; object-fit: cover; border-radius: 8px;">
                                    @else
                                        <div style="width: 40px; height: 50px; background: #f0e7d8; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-book" style="color: #8b5a2b;"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-bold" style="color: #4a3b2c;">{{ $alat->nama_alat }}</div>
                                        <small class="text-muted">
                                            <i class="bi bi-pencil"></i> {{ $alat->penulis ?: '-' }} | 
                                            <i class="bi bi-building"></i> {{ $alat->penerbit ?: '-' }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 16px;">
                                <span class="badge" style="background: #e8d5b5; color: #8b5a2b; border-radius: 12px;">
                                    {{ $alat->kategori->nama_kategori ?? '-' }}
                                </span>
                            </td>
                            <td style="padding: 16px;">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold" style="color: #4a3b2c;">{{ $alat->stok_total }}</span>
                                    <small class="text-muted">Tersedia: {{ $alat->stok_tersedia }}</small>
                                </div>
                            </td>
                            <td style="padding: 16px;">
                                <span style="color: #d9534f; font-weight: 600;">
                                    Rp {{ number_format($alat->harga_sewa_per_hari, 0, ',', '.') }}
                                </span>
                            </td>
                            <td style="padding: 16px;">
                                @php
                                    $kondisiBadge = [
                                        'baik' => ['bg' => '#d4edda', 'color' => '#155724', 'text' => 'Baik'],
                                        'rusak_ringan' => ['bg' => '#fff3cd', 'color' => '#856404', 'text' => 'Rusak Ringan'],
                                        'rusak_berat' => ['bg' => '#f8d7da', 'color' => '#721c24', 'text' => 'Rusak Berat']
                                    ][$alat->kondisi] ?? ['bg' => '#e2e3e5', 'color' => '#383d41', 'text' => ucfirst($alat->kondisi)];
                                @endphp
                                <span class="badge" style="background: {{ $kondisiBadge['bg'] }}; color: {{ $kondisiBadge['color'] }}; border-radius: 12px;">
                                    {{ $kondisiBadge['text'] }}
                                </span>
                            </td>
                            <td style="padding: 16px; text-align: center;">
                                <div class="d-flex gap-2 justify-content-center">
                                    <!-- Tombol Detail -->
                                    <a href="{{ route('petugas.alat.show', $alat->id) }}" class="btn btn-sm" 
                                       style="background: #e8f4f8; color: #0c5460; border-radius: 12px; padding: 6px 12px;" 
                                       title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('petugas.alat.edit', $alat->id) }}" class="btn btn-sm" 
                                       style="background: #fff3cd; color: #856404; border-radius: 12px; padding: 6px 12px;" 
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center gap-3">
                                    <div style="width: 80px; height: 80px; background: #f0e7d8; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-emoji-frown fs-1" style="color: #8b5a2b;"></i>
                                    </div>
                                    <div>
                                        <h5 style="color: #4a3b2c;">Belum Ada Data Buku</h5>
                                        <p class="text-muted">Silakan tambah buku baru melalui tombol "Tambah Buku"</p>
                                    </div>
                                    <a href="{{ route('petugas.alat.create') }}" class="btn" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 16px;">
                                        <i class="bi bi-plus-lg me-2"></i>Tambah Buku
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Card Footer dengan Pagination -->
        @if($alats->hasPages())
        <div class="card-footer bg-transparent border-0 p-4" style="border-top: 2px solid #f0e7d8;">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Menampilkan {{ $alats->firstItem() }} - {{ $alats->lastItem() }} dari {{ $alats->total() }} buku
                </small>
                <div>
                    {{ $alats->withQueryString()->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
/* Font untuk judul */
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap');

body {
    font-family: 'Inter', sans-serif;
    background: #faf7f2;
}

/* Styling untuk tabel */
.table-hover tbody tr:hover {
    background: #fefcf9 !important;
    cursor: pointer;
}

/* Styling untuk pagination */
.pagination {
    margin-bottom: 0;
}

.pagination .page-link {
    color: #8b5a2b;
    border-color: #e0d5c5;
    margin: 0 3px;
    border-radius: 8px !important;
}

.pagination .page-link:hover {
    background: #8b5a2b;
    color: white;
    border-color: #8b5a2b;
}

.pagination .active .page-link {
    background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%);
    border-color: #8b5a2b;
    color: white;
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
    .card-header .d-flex {
        flex-direction: column;
        align-items: stretch !important;
    }
    
    .table-responsive {
        font-size: 0.85rem;
    }
    
    .btn {
        padding: 8px 16px !important;
    }
}
</style>
@endsection