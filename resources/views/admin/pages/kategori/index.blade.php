@extends('layouts.app')

@section('title', 'Kelola Kategori Buku')

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
    <!-- Header dengan desain buku -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <div class="d-flex align-items-center gap-3 mb-2">
                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-tags fs-3 text-white"></i>
                </div>
                <div>
                    <h2 class="fw-bold mb-1" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">Kategori Buku</h2>
                    <p class="mb-0" style="color: #8b7a6b;">
                        <i class="bi bi-bookmarks me-1"></i>Kelola kategori untuk pengelompokan koleksi buku
                    </p>
                </div>
            </div>
        </div>
        <a href="{{ route($routePrefix . '.kategori.create') }}" class="btn d-flex align-items-center px-4 py-3" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 16px; font-weight: 600; border: none; box-shadow: 0 10px 20px -5px rgba(139, 90, 43, 0.3);">
            <i class="bi bi-plus-lg me-2"></i> Tambah Kategori
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2); overflow: hidden;">
                <!-- Card Header dengan ornamen buku -->
                <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-book-half" style="color: #8b5a2b;"></i>
                        <span class="fw-medium" style="color: #6b5c4d;">Daftar Kategori Buku</span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0" style="border-collapse: separate; border-spacing: 0;">
                        <thead style="background: #f8f5f0;">
                            <tr>
                                <th class="ps-4 py-3" style="color: #6b5c4d; font-weight: 600; width: 5%;">No</th>
                                <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Nama Kategori</th>
                                <th class="py-3" style="color: #6b5c4d; font-weight: 600; width: 20%;">Jumlah Buku</th>
                                <th class="text-end pe-4 py-3" style="color: #6b5c4d; font-weight: 600; width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategoris as $index => $kategori)
                                <tr style="border-bottom: 1px solid #f0e7d8;">
                                    <td class="ps-4 py-3">
                                        <span class="fw-bold" style="color: #8b7a6b;">{{ $kategoris->firstItem() + $index }}</span>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div style="width: 45px; height: 45px; background: #f0e7d8; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                                @php
                                                    $icons = ['bi-book', 'bi-book-half', 'bi-book-fill', 'bi-journal', 'bi-journal-text', 'bi-journal-bookmark-fill'];
                                                    $randomIcon = $icons[array_rand($icons)];
                                                @endphp
                                                <i class="bi {{ $randomIcon }}" style="color: #8b5a2b; font-size: 1.2rem;"></i>
                                            </div>
                                            <div>
                                                <span class="fw-bold" style="color: #4a3b2c; font-size: 1.1rem;">{{ $kategori->nama_kategori }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <span class="badge py-2 px-3" style="background: #f0e7d8; color: #8b5a2b; border-radius: 30px; font-weight: 500;">
                                            <i class="bi bi-layers me-1"></i>
                                            {{ $kategori->alat_count }} {{ $kategori->alat_count > 1 ? 'Buku' : 'Buku' }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4 py-3">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route($routePrefix . '.kategori.edit', $kategori) }}" 
                                               class="btn d-flex align-items-center justify-content-center" 
                                               style="background: #f0e7d8; color: #8b5a2b; border-radius: 12px; padding: 8px 16px; font-weight: 500;"
                                               title="Edit Kategori">
                                                <i class="bi bi-pencil me-1"></i> Edit
                                            </a>
                                            
                                            <form action="{{ route($routePrefix . '.kategori.destroy', $kategori) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn d-flex align-items-center justify-content-center" 
                                                        style="background: #f0e7d8; color: #dc3545; border-radius: 12px; padding: 8px 16px; font-weight: 500;"
                                                        title="Hapus Kategori"
                                                        onclick="return confirm('Yakin ingin menghapus kategori {{ $kategori->nama_kategori }}? Semua buku dalam kategori ini akan terpengaruh.')">
                                                    <i class="bi bi-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center py-4">
                                            <div style="font-size: 80px; opacity: 0.2; margin-bottom: 20px;">
                                                📚
                                            </div>
                                            <i class="bi bi-tags" style="font-size: 3rem; color: #8b5a2b; opacity: 0.3; margin-bottom: 15px;"></i>
                                            <h5 class="fw-bold mb-2" style="color: #4a3b2c;">Belum Ada Kategori</h5>
                                            <p class="text-muted mb-3" style="color: #8b7a6b;">Mulai dengan menambah kategori buku pertama Anda</p>
                                            <a href="{{ route($routePrefix . '.kategori.create') }}" class="btn px-4 py-2" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 12px; font-weight: 500;">
                                                <i class="bi bi-plus-lg me-2"></i> Tambah Kategori
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($kategoris->hasPages())
                    <div class="card-footer bg-transparent border-0 p-4" style="border-top: 2px solid #f0e7d8;">
                        <div class="d-flex justify-content-center">
                            <div class="pagination-wrapper" style="background: #f8f5f0; padding: 8px; border-radius: 50px;">
                                {{ $kategoris->links() }}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Card Footer dengan info -->
                <div class="card-footer bg-transparent border-0 p-4 text-end" style="border-top: 2px solid #f0e7d8;">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Total {{ $kategoris->total() }} kategori buku
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

/* Styling untuk tabel */
.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background: #f8f5f0;
}

.table tbody tr:last-child {
    border-bottom: none !important;
}

/* Styling untuk badge */
.badge {
    font-weight: 500;
    letter-spacing: 0.3px;
}

/* Styling untuk tombol */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px -5px rgba(0,0,0,0.2);
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

.page-item.disabled .page-link {
    color: #c9b9a8;
    background: transparent;
}

/* Animasi untuk icon buku */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.bi-tags {
    animation: float 4s ease-in-out infinite;
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
        padding: 1rem;
    }
    
    .btn {
        padding: 8px 12px !important;
    }
    
    .d-flex.gap-2 {
        flex-direction: column;
    }
}
</style>
@endsection