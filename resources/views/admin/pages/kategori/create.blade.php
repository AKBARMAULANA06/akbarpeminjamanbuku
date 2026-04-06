@extends('layouts.app')

@section('title', 'Tambah Kategori Buku')

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

@section('page-title', 'Tambah Kategori Buku')

@php
    $routePrefix = auth()->user()->role === 'petugas' ? 'petugas' : 'admin';
@endphp

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Breadcrumb dengan desain buku -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb p-3" style="background: white; border-radius: 50px; box-shadow: 0 5px 15px -5px rgba(100, 70, 40, 0.1);">
                    <li class="breadcrumb-item">
                        <a href="{{ route($routePrefix . '.dashboard') }}" style="color: #8b5a2b; text-decoration: none;">
                            <i class="bi bi-house-door me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route($routePrefix . '.kategori.index') }}" style="color: #8b5a2b; text-decoration: none;">
                            <i class="bi bi-tags me-1"></i>Kategori
                        </a>
                    </li>
                    <li class="breadcrumb-item active" style="color: #6b5c4d;">Tambah Kategori</li>
                </ol>
            </nav>

            <!-- Header dengan desain buku -->
            <div class="d-flex align-items-center gap-3 mb-4">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(139, 90, 43, 0.3);">
                    <i class="bi bi-folder-plus fs-2 text-white"></i>
                </div>
                <div>
                    <h2 class="fw-bold mb-1" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">Tambah Kategori Buku</h2>
                    <p class="mb-0" style="color: #8b7a6b;">Tambahkan kategori baru untuk koleksi buku perpustakaan</p>
                </div>
            </div>

            <!-- Card Form -->
            <div class="card border-0" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2); overflow: hidden;">
                <!-- Card Header dengan ornamen buku -->
                <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-journal-plus" style="color: #8b5a2b;"></i>
                        <span class="fw-medium" style="color: #6b5c4d;">Formulir Tambah Kategori</span>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Info Alert -->
                    <div class="alert d-flex align-items-center mb-4" style="background: #f0e7d8; color: #8b5a2b; border: none; border-radius: 16px;">
                        <i class="bi bi-info-circle-fill me-3 fs-5"></i>
                        <div>
                            <strong>Informasi:</strong> Kategori akan digunakan untuk mengelompokkan buku-buku di perpustakaan.
                        </div>
                    </div>

                    <form action="{{ route($routePrefix . '.kategori.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nama_kategori" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                <i class="bi bi-tag me-1" style="color: #8b5a2b;"></i>Nama Kategori <span class="text-danger">*</span>
                            </label>
                            
                            <div class="position-relative">
                                <input type="text" 
                                       class="form-control @error('nama_kategori') is-invalid @enderror" 
                                       id="nama_kategori" 
                                       name="nama_kategori" 
                                       value="{{ old('nama_kategori') }}"
                                       placeholder="Contoh: Novel, Komik, Ensiklopedia, dll"
                                       required
                                       style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9; font-size: 1rem;">
                                
                                <!-- Icon buku di dalam input (sebagai dekorasi) -->
                                <div class="position-absolute end-0 top-50 translate-middle-y pe-3" style="pointer-events: none;">
                                    <i class="bi bi-journal-text" style="color: #8b5a2b; opacity: 0.3;"></i>
                                </div>
                            </div>
                            
                            @error('nama_kategori')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                            
                            <small class="text-muted mt-2 d-block">
                                <i class="bi bi-lightbulb me-1" style="color: #8b5a2b;"></i>
                                Gunakan nama yang deskriptif dan mudah dipahami
                            </small>
                        </div>

                        <!-- Preview card (hanya untuk visualisasi) -->
                        <div class="mb-4 p-4" style="background: #f8f5f0; border-radius: 20px;">
                            <h6 class="fw-bold mb-3" style="color: #4a3b2c; font-size: 0.9rem;">
                                <i class="bi bi-eye me-2"></i>Preview Kategori
                            </h6>
                            <div class="d-flex align-items-center gap-3" id="categoryPreview" style="opacity: 0.7;">
                                <div style="width: 45px; height: 45px; background: #f0e7d8; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-bookmark" style="color: #8b5a2b;"></i>
                                </div>
                                <div>
                                    <span class="fw-bold" style="color: #4a3b2c;" id="previewText">Nama Kategori</span>
                                    <br>
                                    <span class="badge py-1 px-2" style="background: #f0e7d8; color: #8b5a2b; font-size: 0.7rem;">Preview</span>
                                </div>
                            </div>
                        </div>

                        <!-- Divider dengan ornamen -->
                        <div class="d-flex align-items-center gap-3 my-4">
                            <div style="flex: 1; height: 2px; background: linear-gradient(to right, transparent, #8b5a2b, transparent);"></div>
                            <i class="bi bi-bookmark-heart" style="color: #8b5a2b; font-size: 1.2rem;"></i>
                            <div style="flex: 1; height: 2px; background: linear-gradient(to right, transparent, #8b5a2b, transparent);"></div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-3 justify-content-end">
                            <a href="{{ route($routePrefix . '.kategori.index') }}" class="btn px-5 py-3" style="background: #f0e7d8; color: #8b5a2b; border-radius: 16px; font-weight: 600;">
                                <i class="bi bi-x-lg me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn px-5 py-3" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 16px; font-weight: 600; border: none; box-shadow: 0 10px 20px -5px rgba(139, 90, 43, 0.3);">
                                <i class="bi bi-check-lg me-2"></i>Simpan Kategori
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Card Footer dengan watermark buku -->
                <div class="card-footer bg-transparent border-0 p-4 text-end" style="border-top: 2px solid #f0e7d8;">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Field dengan tanda <span class="text-danger">*</span> wajib diisi
                    </small>
                </div>
            </div>

            <!-- Card Tips (opsional) -->
            <div class="card border-0 mt-4" style="border-radius: 20px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1);">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3" style="color: #4a3b2c;">
                        <i class="bi bi-lightbulb me-2" style="color: #8b5a2b;"></i>Tips Menambah Kategori
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex gap-2">
                                <i class="bi bi-check-circle-fill" style="color: #8b5a2b; font-size: 1rem;"></i>
                                <span class="small" style="color: #6b5c4d;">Gunakan nama yang umum dan mudah dikenali</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-2">
                                <i class="bi bi-check-circle-fill" style="color: #8b5a2b; font-size: 1rem;"></i>
                                <span class="small" style="color: #6b5c4d;">Hindari singkatan yang tidak jelas</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-2">
                                <i class="bi bi-check-circle-fill" style="color: #8b5a2b; font-size: 1rem;"></i>
                                <span class="small" style="color: #6b5c4d;">Contoh: Fiksi, Non-Fiksi, Novel, Komik</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-2">
                                <i class="bi bi-check-circle-fill" style="color: #8b5a2b; font-size: 1rem;"></i>
                                <span class="small" style="color: #6b5c4d;">Kategori yang baik memudahkan pencarian</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk Preview -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputNama = document.getElementById('nama_kategori');
    const previewText = document.getElementById('previewText');
    
    if (inputNama && previewText) {
        inputNama.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                previewText.textContent = this.value;
                previewText.style.color = '#4a3b2c';
                previewText.style.fontWeight = 'bold';
            } else {
                previewText.textContent = 'Nama Kategori';
                previewText.style.color = '#8b7a6b';
                previewText.style.fontWeight = 'normal';
            }
        });
    }
});
</script>

<!-- CSS Tambahan -->
<style>
/* Font untuk judul */
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap');

body {
    font-family: 'Inter', sans-serif;
    background: #faf7f2;
}

/* Styling untuk form */
.form-control {
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #8b5a2b !important;
    box-shadow: 0 0 0 0.2rem rgba(139, 90, 43, 0.25) !important;
    outline: none;
}

/* Efek hover untuk card */
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

/* Styling untuk breadcrumb */
.breadcrumb {
    background: white;
    border-radius: 50px;
    padding: 12px 20px;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: #8b5a2b;
    content: "›";
    font-size: 1.2rem;
    line-height: 1;
}

.breadcrumb-item a:hover {
    text-decoration: underline !important;
}

/* Styling untuk tombol */
.btn {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px -5px rgba(0,0,0,0.2) !important;
}

/* Animasi untuk preview */
#categoryPreview {
    transition: all 0.3s ease;
}

#categoryPreview:hover {
    opacity: 1 !important;
    transform: translateX(5px);
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
        padding: 12px 24px !important;
    }
    
    .d-flex.gap-3 {
        flex-direction: column;
    }
}
</style>
@endsection