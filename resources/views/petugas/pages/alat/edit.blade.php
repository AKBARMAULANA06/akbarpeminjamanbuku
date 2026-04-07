@extends('layouts.app')

@section('title', 'Edit Buku')

@section('sidebar')
    @if(auth()->user()->role === 'petugas')
        @include('petugas.components.sidebar')
    @else
        @include('admin.components.sidebar')
    @endif

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <div class="d-flex align-items-center gap-3 mb-4">
        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-pencil-square fs-2 text-white"></i>
        </div>
        <div>
            <h2 class="fw-bold mb-1" style="color: #4a3b2c;">Edit Buku</h2>
            <p class="mb-0" style="color: #8b7a6b;">Perbarui informasi buku yang ada</p>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="card border-0" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2);">
        <div class="card-body p-4">
            <form action="{{ route('petugas.alat.update', $alat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Kode Buku</label>
                        <input type="text" class="form-control" value="{{ $alat->kode_alat }}" readonly style="background-color: #e9ecef;">
                        <small class="text-muted">Kode buku tidak dapat diubah</small>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Kategori *</label>
                        <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id', $alat->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Buku *</label>
                    <input type="text" name="nama_alat" class="form-control @error('nama_alat') is-invalid @enderror" 
                           value="{{ old('nama_alat', $alat->nama_alat) }}" required>
                    @error('nama_alat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Penulis</label>
                        <input type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror" 
                               value="{{ old('penulis', $alat->penulis) }}">
                        @error('penulis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Penerbit</label>
                        <input type="text" name="penerbit" class="form-control @error('penerbit') is-invalid @enderror" 
                               value="{{ old('penerbit', $alat->penerbit) }}">
                        @error('penerbit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control @error('tahun_terbit') is-invalid @enderror" 
                               value="{{ old('tahun_terbit', $alat->tahun_terbit) }}" min="1900" max="{{ date('Y') }}">
                        @error('tahun_terbit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Denda per Hari (Rp) *</label>
                        <input type="number" name="harga_sewa_per_hari" class="form-control @error('harga_sewa_per_hari') is-invalid @enderror" 
                               value="{{ old('harga_sewa_per_hari', $alat->harga_sewa_per_hari) }}" required>
                        @error('harga_sewa_per_hari')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Stok Total *</label>
                        <input type="number" name="stok_total" class="form-control @error('stok_total') is-invalid @enderror" 
                               value="{{ old('stok_total', $alat->stok_total) }}" required>
                        <small class="text-muted">Stok tersedia saat ini: <strong>{{ $alat->stok_tersedia }}</strong> eksemplar</small>
                        @error('stok_total')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Kondisi *</label>
                        <select name="kondisi" class="form-select @error('kondisi') is-invalid @enderror" required>
                            <option value="baik" {{ old('kondisi', $alat->kondisi) == 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="rusak_ringan" {{ old('kondisi', $alat->kondisi) == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="rusak_berat" {{ old('kondisi', $alat->kondisi) == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>
                        @error('kondisi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4">{{ old('deskripsi', $alat->deskripsi) }}</textarea>
                    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Cover Buku</label>
                    @if($alat->foto)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $alat->foto) }}" alt="Cover" style="max-width: 150px; border-radius: 8px;">
                        </div>
                    @endif
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah cover (Max: 2MB)</small>
                    @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <input type="hidden" name="stok_tersedia" value="{{ $alat->stok_tersedia }}">
                
                <div class="d-flex gap-3 justify-content-end mt-4">
                    <a href="{{ route('petugas.alat.index') }}" class="btn btn-secondary px-5 py-3">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn px-5 py-3" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white;">
                        <i class="bi bi-check-lg me-2"></i>Update Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection