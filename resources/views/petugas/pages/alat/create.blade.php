@extends('layouts.app')

@section('title', 'Tambah Buku')

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
    <div class="d-flex align-items-center gap-3 mb-4">
        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(139, 90, 43, 0.3);">
            <i class="bi bi-journal-plus fs-2 text-white"></i>
        </div>
        <div>
            <h2 class="fw-bold mb-1" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">Tambah Buku Baru</h2>
            <p class="mb-0" style="color: #8b7a6b;">Lengkapi informasi buku untuk menambah koleksi perpustakaan</p>
        </div>
    </div>

    <!-- Tampilkan error validasi jika ada -->
    @if($errors->any())
        <div class="alert alert-danger mb-4" style="border-radius: 16px; background: #f8d7da; color: #721c24; border: none;">
            <div class="d-flex align-items-center gap-2 mb-2">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <strong>Terjadi Kesalahan:</strong>
            </div>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-book-half" style="color: #8b5a2b;"></i>
                <span class="fw-medium" style="color: #6b5c4d;">Formulir Tambah Buku</span>
            </div>
        </div>

        <div class="card-body p-4">
            @php
                $routePrefix = auth()->user()->role === 'petugas' ? 'petugas' : 'admin';
            @endphp
            
            <form action="{{ route($routePrefix . '.alat.store') }}" method="POST" enctype="multipart/form-data" id="formTambahBuku">
                @csrf
                
                <!-- Kode Buku & Kategori -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="kode_alat" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                            <i class="bi bi-upc-scan me-1" style="color: #8b5a2b;"></i>ISBN / Kode Buku *
                        </label>
                        <input type="text" class="form-control @error('kode_alat') is-invalid @enderror" 
                               id="kode_alat" name="kode_alat" value="{{ old('kode_alat') }}" 
                               placeholder="Contoh: BUKU001 atau 978-602-1234-56-7" required
                               style="padding: 12px 16px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Masukkan ISBN atau kode unik buku. Kode harus <strong>BELUM PERNAH digunakan</strong>.
                        </small>
                        @error('kode_alat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="kategori_id" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                            <i class="bi bi-tag me-1" style="color: #8b5a2b;"></i>Kategori Buku *
                        </label>
                        <select class="form-select @error('kategori_id') is-invalid @enderror" 
                                id="kategori_id" name="kategori_id" required
                                style="padding: 12px 16px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Judul Buku -->
                <div class="mb-4">
                    <label for="nama_alat" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                        <i class="bi bi-book me-1" style="color: #8b5a2b;"></i>Judul Buku *
                    </label>
                    <input type="text" class="form-control @error('nama_alat') is-invalid @enderror" 
                           id="nama_alat" name="nama_alat" value="{{ old('nama_alat') }}" 
                           placeholder="Masukkan judul lengkap buku" required
                           style="padding: 12px 16px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                    @error('nama_alat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Penulis & Penerbit -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="penulis" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                            <i class="bi bi-pencil me-1" style="color: #8b5a2b;"></i>Penulis *
                        </label>
                        <input type="text" class="form-control @error('penulis') is-invalid @enderror" 
                               id="penulis" name="penulis" value="{{ old('penulis') }}" 
                               placeholder="Nama penulis buku" required
                               style="padding: 12px 16px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                        @error('penulis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="penerbit" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                            <i class="bi bi-building me-1" style="color: #8b5a2b;"></i>Penerbit *
                        </label>
                        <input type="text" class="form-control @error('penerbit') is-invalid @enderror" 
                               id="penerbit" name="penerbit" value="{{ old('penerbit') }}" 
                               placeholder="Nama penerbit" required
                               style="padding: 12px 16px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                        @error('penerbit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Tahun Terbit & Denda -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="tahun_terbit" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                            <i class="bi bi-calendar me-1" style="color: #8b5a2b;"></i>Tahun Terbit *
                        </label>
                        <input type="number" min="1900" max="{{ date('Y') }}" class="form-control @error('tahun_terbit') is-invalid @enderror" 
                               id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit', date('Y')) }}" 
                               placeholder="2024" required
                               style="padding: 12px 16px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                        @error('tahun_terbit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="harga_sewa_per_hari" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                            <i class="bi bi-cash me-1" style="color: #8b5a2b;"></i>Denda per Hari (Rp) *
                        </label>
                        <input type="number" min="0" step="1000" class="form-control @error('harga_sewa_per_hari') is-invalid @enderror" 
                               id="harga_sewa_per_hari" name="harga_sewa_per_hari" value="{{ old('harga_sewa_per_hari', 2000) }}" required
                               style="padding: 12px 16px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                        <small class="text-muted">Denda keterlambatan per hari (contoh: 2000)</small>
                        @error('harga_sewa_per_hari')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Stok Total & Kondisi -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="stok_total" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                            <i class="bi bi-layers me-1" style="color: #8b5a2b;"></i>Jumlah Eksemplar *
                        </label>
                        <input type="number" min="1" step="1" class="form-control @error('stok_total') is-invalid @enderror" 
                               id="stok_total" name="stok_total" value="{{ old('stok_total', 1) }}" required
                               style="padding: 12px 16px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                        <small class="text-muted">Jumlah eksemplar buku yang tersedia</small>
                        @error('stok_total')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="kondisi" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                            <i class="bi bi-clipboard-check me-1" style="color: #8b5a2b;"></i>Kondisi Buku *
                        </label>
                        <select class="form-select @error('kondisi') is-invalid @enderror" 
                                id="kondisi" name="kondisi" required
                                style="padding: 12px 16px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                            <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>Baik (Baru/Layak)</option>
                            <option value="rusak_ringan" {{ old('kondisi') == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="rusak_berat" {{ old('kondisi') == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat (Perlu Perbaikan)</option>
                        </select>
                        @error('kondisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="deskripsi" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                        <i class="bi bi-card-text me-1" style="color: #8b5a2b;"></i>Sinopsis / Deskripsi
                    </label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" name="deskripsi" rows="4" 
                              placeholder="Tuliskan sinopsis atau deskripsi singkat tentang buku"
                              style="padding: 12px 16px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Cover Buku dengan Preview -->
                <div class="mb-4">
                    <label for="foto" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                        <i class="bi bi-image me-1" style="color: #8b5a2b;"></i>Cover Buku (Opsional)
                    </label>
                    
                    <!-- Area Preview Gambar -->
                    <div id="preview-container" class="mb-3 text-center" style="display: none;">
                        <div class="position-relative d-inline-block">
                            <img id="image-preview" src="#" alt="Preview Cover" 
                                 style="max-width: 200px; max-height: 200px; border-radius: 16px; border: 3px solid #8b5a2b; box-shadow: 0 5px 15px rgba(0,0,0,0.2);">
                            <button type="button" id="remove-image" class="btn btn-sm position-absolute top-0 end-0" 
                                    style="background: #dc3545; color: white; border-radius: 50%; width: 30px; height: 30px; padding: 0; transform: translate(50%, -50%);">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Input File -->
                    <div class="input-group">
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                               id="foto" name="foto" accept="image/jpeg,image/png,image/jpg,image/gif"
                               style="padding: 12px 16px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                    </div>
                    <small class="text-muted">Format: JPG, JPEG, PNG, GIF (Max: 2MB)</small>
                    @error('foto')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Divider dengan ornamen -->
                <div class="d-flex align-items-center gap-3 my-4">
                    <div style="flex: 1; height: 2px; background: linear-gradient(to right, transparent, #8b5a2b, transparent);"></div>
                    <i class="bi bi-bookmark-heart" style="color: #8b5a2b; font-size: 1.2rem;"></i>
                    <div style="flex: 1; height: 2px; background: linear-gradient(to right, transparent, #8b5a2b, transparent);"></div>
                </div>
                
                <!-- Tombol Aksi -->
                <div class="d-flex gap-3 justify-content-end">
                    <a href="{{ route($routePrefix . '.alat.index') }}" 
                       class="btn px-5 py-3" 
                       style="background: #f0e7d8; color: #8b5a2b; border-radius: 16px; font-weight: 600;">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn px-5 py-3" id="btnSubmit"
                            style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 16px; font-weight: 600; border: none; box-shadow: 0 10px 20px -5px rgba(139, 90, 43, 0.3);">
                        <i class="bi bi-check-lg me-2"></i>Simpan Buku
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Card Footer -->
        <div class="card-footer bg-transparent border-0 p-4 text-end" style="border-top: 2px solid #f0e7d8;">
            <small class="text-muted">
                <i class="bi bi-info-circle me-1"></i>
                Field dengan tanda * wajib diisi
            </small>
        </div>
    </div>
</div>

<!-- JavaScript untuk Preview Gambar dan Validasi -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fotoInput = document.getElementById('foto');
    const previewContainer = document.getElementById('preview-container');
    const imagePreview = document.getElementById('image-preview');
    const removeButton = document.getElementById('remove-image');
    const form = document.getElementById('formTambahBuku');
    const btnSubmit = document.getElementById('btnSubmit');

    // Fungsi untuk menampilkan preview gambar
    function previewImage(file) {
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            
            reader.readAsDataURL(file);
        }
    }

    // Event ketika memilih file
    fotoInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            // Validasi tipe file
            const fileType = this.files[0].type;
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            
            if (!validTypes.includes(fileType)) {
                alert('Tipe file tidak valid. Harap pilih file gambar (JPG, PNG, GIF)');
                this.value = '';
                previewContainer.style.display = 'none';
                return;
            }
            
            // Validasi ukuran file (max 2MB)
            if (this.files[0].size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 2MB');
                this.value = '';
                previewContainer.style.display = 'none';
                return;
            }
            
            previewImage(this.files[0]);
        }
    });

    // Event untuk menghapus preview
    removeButton.addEventListener('click', function() {
        fotoInput.value = '';
        previewContainer.style.display = 'none';
        imagePreview.src = '#';
    });

    // Validasi form sebelum submit
    form.addEventListener('submit', function(e) {
        let isValid = true;
        let errorMessages = [];

        // Validasi kode alat
        const kodeAlat = document.getElementById('kode_alat').value.trim();
        if (!kodeAlat) {
            errorMessages.push('Kode buku harus diisi');
            isValid = false;
        } else if (kodeAlat.length < 2) {
            errorMessages.push('Kode buku minimal 2 karakter');
            isValid = false;
        }

        // Validasi judul
        const judul = document.getElementById('nama_alat').value.trim();
        if (!judul) {
            errorMessages.push('Judul buku harus diisi');
            isValid = false;
        }

        // Validasi kategori
        const kategori = document.getElementById('kategori_id').value;
        if (!kategori) {
            errorMessages.push('Kategori harus dipilih');
            isValid = false;
        }

        // Validasi penulis
        const penulis = document.getElementById('penulis').value.trim();
        if (!penulis) {
            errorMessages.push('Penulis harus diisi');
            isValid = false;
        }

        // Validasi penerbit
        const penerbit = document.getElementById('penerbit').value.trim();
        if (!penerbit) {
            errorMessages.push('Penerbit harus diisi');
            isValid = false;
        }

        // Validasi tahun terbit
        const tahun = document.getElementById('tahun_terbit').value;
        const tahunNow = new Date().getFullYear();
        if (!tahun) {
            errorMessages.push('Tahun terbit harus diisi');
            isValid = false;
        } else if (tahun.length !== 4 || isNaN(tahun) || tahun < 1900 || tahun > tahunNow) {
            errorMessages.push('Tahun terbit harus 4 digit antara 1900 - ' + tahunNow);
            isValid = false;
        }

        // Validasi denda
        const denda = document.getElementById('harga_sewa_per_hari').value;
        if (denda === '' || denda === null) {
            errorMessages.push('Denda per hari harus diisi');
            isValid = false;
        } else if (denda < 0) {
            errorMessages.push('Denda per hari tidak boleh negatif');
            isValid = false;
        }

        // Validasi stok
        const stok = document.getElementById('stok_total').value;
        if (stok === '' || stok === null) {
            errorMessages.push('Stok harus diisi');
            isValid = false;
        } else if (stok < 1) {
            errorMessages.push('Stok minimal 1');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
            alert('Validasi gagal:\n- ' + errorMessages.join('\n- '));
        } else {
            // Disable button submit untuk mencegah double submit
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Menyimpan...';
        }
    });

    // Auto-format kode alat menjadi huruf besar
    const kodeAlatInput = document.getElementById('kode_alat');
    if (kodeAlatInput) {
        kodeAlatInput.addEventListener('blur', function() {
            this.value = this.value.toUpperCase().trim();
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

.card::before {
    content: '📚';
    position: absolute;
    bottom: -50px;
    right: -50px;
    font-size: 200px;
    opacity: 0.02;
    transform: rotate(-15deg);
    pointer-events: none;
}

/* Styling untuk tombol */
.btn {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px -10px rgba(0,0,0,0.2) !important;
}

/* Efek lipatan halaman */
.card {
    position: relative;
}

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

/* Styling untuk preview gambar */
#preview-container {
    animation: fadeIn 0.3s ease;
}

#preview-container img {
    transition: all 0.3s ease;
}

#preview-container img:hover {
    transform: scale(1.05);
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

/* Spinner untuk loading */
.spinner-border {
    width: 1rem;
    height: 1rem;
    border-width: 0.15em;
}

/* Responsive */
@media (max-width: 768px) {
    .card-body {
        padding: 1.5rem !important;
    }
    
    .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
    
    .d-flex.gap-3 {
        flex-direction: column;
    }
}
</style>
@endsection