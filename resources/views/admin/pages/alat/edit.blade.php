@extends('layouts.app')

@section('title', 'Edit Buku')

@section('sidebar')
    @include('admin.components.sidebar')
@endsection

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('page-title', 'Edit Buku')

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <!-- Breadcrumb dengan desain buku -->
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-3" style="background: white; border-radius: 50px; box-shadow: 0 5px 15px -5px rgba(100, 70, 40, 0.1);">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.alat.index') }}" style="color: #8b5a2b; text-decoration: none;">
                        <i class="bi bi-book-half me-1"></i>Koleksi Buku
                    </a>
                </li>
                <li class="breadcrumb-item active" style="color: #6b5c4d;">Edit Buku</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header dengan desain buku -->
            <div class="d-flex align-items-center gap-3 mb-4">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(139, 90, 43, 0.3);">
                    <i class="bi bi-pencil-square fs-2 text-white"></i>
                </div>
                <div>
                    <h2 class="fw-bold mb-1" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">Edit Buku</h2>
                    <p class="mb-0" style="color: #8b7a6b;">Edit informasi buku dalam koleksi perpustakaan</p>
                </div>
            </div>

            <!-- Card Form -->
            <div class="card border-0" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2); overflow: hidden;">
                <!-- Card Header -->
                <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-journal-text" style="color: #8b5a2b;"></i>
                        <span class="fw-medium" style="color: #6b5c4d;">Form Edit Buku: {{ $alat->nama_alat ?? '' }}</span>
                    </div>
                </div>

                <div class="card-body p-5">
                    @if(isset($alat) && $alat)
                        <form action="{{ route('admin.alat.update', $alat->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                    @else
                        <div class="alert alert-danger">Data buku tidak ditemukan</div>
                        <a href="{{ route('admin.alat.index') }}" class="btn btn-primary">Kembali</a>
                    @endif
                    
                    @if(isset($alat) && $alat)
                        <div class="row g-4">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <!-- ISBN / Kode Buku -->
                                <div class="mb-4">
                                    <label for="kode_alat" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                        <i class="bi bi-upc-scan me-1" style="color: #8b5a2b;"></i>ISBN / Kode Buku *
                                    </label>
                                    <input type="text" class="form-control @error('kode_alat') is-invalid @enderror" 
                                           id="kode_alat" name="kode_alat" 
                                           value="{{ old('kode_alat', $alat->kode_alat) }}" required
                                           style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                                    @error('kode_alat')
                                        <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Judul Buku -->
                                <div class="mb-4">
                                    <label for="nama_alat" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                        <i class="bi bi-book me-1" style="color: #8b5a2b;"></i>Judul Buku *
                                    </label>
                                    <input type="text" class="form-control @error('nama_alat') is-invalid @enderror" 
                                           id="nama_alat" name="nama_alat" 
                                           value="{{ old('nama_alat', $alat->nama_alat) }}" required
                                           style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                                    @error('nama_alat')
                                        <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Kategori -->
                                <div class="mb-4">
                                    <label for="kategori_id" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                        <i class="bi bi-tag me-1" style="color: #8b5a2b;"></i>Kategori Buku *
                                    </label>
                                    <select class="form-select @error('kategori_id') is-invalid @enderror" 
                                            id="kategori_id" name="kategori_id" required
                                            style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                                        @if(isset($kategoris) && $kategoris->count() > 0)
                                            @foreach($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}" 
                                                    {{ old('kategori_id', $alat->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                                    {{ $kategori->nama_kategori }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="">Tidak ada kategori</option>
                                        @endif
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Penulis -->
                                <div class="mb-4">
                                    <label for="penulis" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                        <i class="bi bi-pencil me-1" style="color: #8b5a2b;"></i>Penulis
                                    </label>
                                    <input type="text" class="form-control" 
                                           id="penulis" name="penulis" 
                                           value="{{ old('penulis', $alat->penulis) }}" 
                                           placeholder="Nama penulis buku"
                                           style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                                </div>
                            </div>
                            
                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <!-- Penerbit -->
                                <div class="mb-4">
                                    <label for="penerbit" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                        <i class="bi bi-building me-1" style="color: #8b5a2b;"></i>Penerbit
                                    </label>
                                    <input type="text" class="form-control" 
                                           id="penerbit" name="penerbit" 
                                           value="{{ old('penerbit', $alat->penerbit) }}" 
                                           placeholder="Nama penerbit"
                                           style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                                </div>
                                
                                <!-- Tahun Terbit -->
                                <div class="mb-4">
                                    <label for="tahun_terbit" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                        <i class="bi bi-calendar me-1" style="color: #8b5a2b;"></i>Tahun Terbit
                                    </label>
                                    <input type="number" min="1900" max="{{ date('Y') }}" class="form-control" 
                                           id="tahun_terbit" name="tahun_terbit" 
                                           value="{{ old('tahun_terbit', $alat->tahun_terbit) }}" 
                                           placeholder="2024"
                                           style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                                </div>
                                
                                <!-- Denda per Hari -->
                                <div class="mb-4">
                                    <label for="harga_sewa_per_hari" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                        <i class="bi bi-cash me-1" style="color: #8b5a2b;"></i>Denda per Hari (Rp) *
                                    </label>
                                    <input type="number" min="0" step="1000" class="form-control @error('harga_sewa_per_hari') is-invalid @enderror" 
                                           id="harga_sewa_per_hari" name="harga_sewa_per_hari" 
                                           value="{{ old('harga_sewa_per_hari', $alat->harga_sewa_per_hari) }}" 
                                           required
                                           style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                                    <small class="text-muted mt-2 d-block">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Denda keterlambatan per hari (contoh: 5000 untuk Rp 5.000)
                                    </small>
                                    @error('harga_sewa_per_hari')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi / Sinopsis -->
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                <i class="bi bi-card-text me-1" style="color: #8b5a2b;"></i>Sinopsis / Deskripsi
                            </label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="5" 
                                      placeholder="Tuliskan sinopsis atau deskripsi singkat tentang buku"
                                      style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">{{ old('deskripsi', $alat->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Stok -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="stok_total" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                    <i class="bi bi-layers me-1" style="color: #8b5a2b;"></i>Jumlah Eksemplar *
                                </label>
                                <input type="number" min="0" class="form-control @error('stok_total') is-invalid @enderror" 
                                       id="stok_total" name="stok_total" 
                                       value="{{ old('stok_total', $alat->stok_total) }}" required
                                       style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                                @error('stok_total')
                                    <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="stok_tersedia" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                    <i class="bi bi-check-circle me-1" style="color: #8b5a2b;"></i>Eksemplar Tersedia *
                                </label>
                                <input type="number" min="0" class="form-control @error('stok_tersedia') is-invalid @enderror" 
                                       id="stok_tersedia" name="stok_tersedia" 
                                       value="{{ old('stok_tersedia', $alat->stok_tersedia) }}" required
                                       style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                                @error('stok_tersedia')
                                    <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Kondisi Buku -->
                        <div class="mb-4">
                            <label for="kondisi" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                <i class="bi bi-clipboard-check me-1" style="color: #8b5a2b;"></i>Kondisi Buku *
                            </label>
                            <select class="form-select @error('kondisi') is-invalid @enderror" 
                                    id="kondisi" name="kondisi" required
                                    style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                                <option value="baik" {{ old('kondisi', $alat->kondisi) == 'baik' ? 'selected' : '' }}>Baik (Layak Baca)</option>
                                <option value="rusak_ringan" {{ old('kondisi', $alat->kondisi) == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan (Sobek kecil/coretan)</option>
                                <option value="rusak_berat" {{ old('kondisi', $alat->kondisi) == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat (Halaman hilang/rusak parah)</option>
                            </select>
                            @error('kondisi')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Cover Buku -->
                        <div class="mb-4">
                            <label for="foto" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                <i class="bi bi-image me-1" style="color: #8b5a2b;"></i>Cover Buku (Kosongkan jika tidak ingin mengubah)
                            </label>
                            
                            @if($alat->foto)
                                @php
                                    $fotoPath = 'storage/' . $alat->foto;
                                    $fullPath = public_path($fotoPath);
                                @endphp
                                @if(file_exists($fullPath))
                                    <div class="mb-3 position-relative d-inline-block">
                                        <img src="{{ asset($fotoPath) }}" alt="Cover Buku" 
                                             style="max-width: 200px; max-height: 200px; border-radius: 16px; border: 3px solid #8b5a2b; box-shadow: 0 5px 15px rgba(0,0,0,0.2);">
                                        <div class="position-absolute top-0 start-0 m-2">
                                            <span class="badge py-2 px-3" style="background: #8b5a2b; color: white;">Cover Saat Ini</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-warning p-3 mb-3" style="border-radius: 16px;">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        File cover tidak ditemukan. Silakan upload ulang.
                                    </div>
                                @endif
                            @endif
                            
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                                   id="foto" name="foto" accept="image/*" onchange="previewImage(this)"
                                   style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                            
                            <!-- Preview Gambar Baru -->
                            <div id="previewContainer" class="mt-3" style="display: none;">
                                <p class="small text-muted mb-2">Preview Cover Baru:</p>
                                <img id="imagePreview" src="#" alt="Preview Cover Baru" 
                                     style="max-width: 150px; max-height: 150px; border-radius: 12px; border: 2px solid #8b5a2b;">
                            </div>
                            
                            <small class="text-muted">Format: JPG, PNG (Max: 2MB)</small>
                            @error('foto')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Divider -->
                        <div class="d-flex align-items-center gap-3 my-5">
                            <div style="flex: 1; height: 2px; background: linear-gradient(to right, transparent, #8b5a2b, transparent);"></div>
                            <i class="bi bi-bookmark-heart-fill" style="color: #8b5a2b; font-size: 1.2rem;"></i>
                            <div style="flex: 1; height: 2px; background: linear-gradient(to right, transparent, #8b5a2b, transparent);"></div>
                        </div>
                        
                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-3 justify-content-end">
                            <a href="{{ route('admin.alat.index') }}" class="btn px-5 py-3" style="background: #f0e7d8; color: #8b5a2b; border-radius: 16px; font-weight: 600;">
                                <i class="bi bi-x-lg me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn px-5 py-3" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 16px; font-weight: 600; border: none; box-shadow: 0 10px 20px -5px rgba(139, 90, 43, 0.3);">
                                <i class="bi bi-check-lg me-2"></i>Update Buku
                            </button>
                        </div>
                    </form>
                    @endif
                </div>

                <!-- Card Footer -->
                <div class="card-footer bg-transparent border-0 p-4 text-end" style="border-top: 2px solid #f0e7d8;">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Field dengan tanda <span class="text-danger">*</span> wajib diisi
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk Preview Gambar -->
<script>
function previewImage(input) {
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewContainer.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        previewContainer.style.display = 'none';
    }
}

// Validasi stok
document.addEventListener('DOMContentLoaded', function() {
    const stokTotal = document.getElementById('stok_total');
    const stokTersedia = document.getElementById('stok_tersedia');
    
    if (stokTotal && stokTersedia) {
        stokTotal.addEventListener('change', function() {
            if (parseInt(stokTersedia.value) > parseInt(this.value)) {
                stokTersedia.value = this.value;
            }
        });
        
        stokTersedia.addEventListener('change', function() {
            if (parseInt(this.value) > parseInt(stokTotal.value)) {
                this.value = stokTotal.value;
            }
        });
    }
});
</script>

<!-- CSS Tambahan -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap');

body {
    font-family: 'Inter', sans-serif;
    background: #faf7f2;
}

/* Styling untuk form */
.form-control, .form-select {
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
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

/* Styling untuk tombol */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px -5px rgba(0,0,0,0.2) !important;
}

/* Preview container */
#previewContainer {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
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

/* Alert styling */
.alert {
    border: none;
    border-radius: 16px;
}
</style>
@endsection