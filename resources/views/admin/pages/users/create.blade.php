@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('sidebar')
    @include('admin.components.sidebar')
@endsection

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <!-- Breadcrumb -->
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-3" style="background: white; border-radius: 50px;">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.users.index') }}" style="color: #8b5a2b;">Manajemen Anggota</a>
                </li>
                <li class="breadcrumb-item active">Tambah Anggota</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2);">
                <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
                    <h5 class="mb-0 fw-bold" style="color: #4a3b2c;">Tambah Anggota Baru</h5>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        
                        <!-- Nama Lengkap -->
                        <div class="mb-4">
                            <label class="form-label fw-medium" style="color: #4a3b2c;">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   placeholder="Masukkan nama lengkap" required
                                   style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5;">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="form-label fw-medium" style="color: #4a3b2c;">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="contoh@email.com" required
                                   style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5;">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <label class="form-label fw-medium" style="color: #4a3b2c;">Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror" required
                                    style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5;">
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Anggota</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label class="form-label fw-medium" style="color: #4a3b2c;">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   placeholder="Minimal 8 karakter" required
                                   style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5;">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-4">
                            <label class="form-label fw-medium" style="color: #4a3b2c;">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" 
                                   class="form-control" 
                                   placeholder="Ulangi password" required
                                   style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5;">
                        </div>

                        <div class="d-flex gap-3 justify-content-end">
                            <a href="{{ route('admin.users.index') }}" class="btn px-5 py-3" style="background: #f0e7d8; color: #8b5a2b; border-radius: 16px; font-weight: 600;">
                                Batal
                            </a>
                            <button type="submit" class="btn px-5 py-3" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 16px; font-weight: 600; border: none;">
                                Simpan Anggota
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection