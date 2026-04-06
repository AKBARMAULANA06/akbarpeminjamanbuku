@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('sidebar')
    @include('admin.components.sidebar')
@endsection

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <!-- Breadcrumb dengan desain buku -->
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-3" style="background: white; border-radius: 50px; box-shadow: 0 5px 15px -5px rgba(100, 70, 40, 0.1);">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.users.index') }}" style="color: #8b5a2b; text-decoration: none;">
                        <i class="bi bi-people-fill me-1"></i>Manajemen Anggota
                    </a>
                </li>
                <li class="breadcrumb-item active" style="color: #6b5c4d;">Edit Anggota</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header dengan desain buku -->
            <div class="d-flex align-items-center gap-3 mb-4">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(139, 90, 43, 0.3);">
                    <i class="bi bi-pencil-square fs-2 text-white"></i>
                </div>
                <div>
                    <h2 class="fw-bold mb-1" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">Edit Anggota</h2>
                    <p class="mb-0" style="color: #8b7a6b;">Edit data anggota perpustakaan</p>
                </div>
            </div>

            <!-- Card Form -->
            <div class="card border-0" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2); overflow: hidden;">
                <!-- Card Header -->
                <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-person-badge" style="color: #8b5a2b;"></i>
                        <span class="fw-medium" style="color: #6b5c4d;">Form Edit Anggota: {{ $user->name }}</span>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nama Lengkap -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                <i class="bi bi-person-circle me-1" style="color: #8b5a2b;"></i>Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <div class="position-relative">
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $user->name) }}" 
                                       required 
                                       placeholder="Masukkan nama lengkap"
                                       style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                                <div class="position-absolute end-0 top-50 translate-middle-y pe-3" style="pointer-events: none;">
                                    <i class="bi bi-journal-text" style="color: #8b5a2b; opacity: 0.3;"></i>
                                </div>
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                <i class="bi bi-envelope me-1" style="color: #8b5a2b;"></i>Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required 
                                   placeholder="contoh@email.com"
                                   style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                            @error('email')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <label for="role" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                <i class="bi bi-shield me-1" style="color: #8b5a2b;"></i>Role <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('role') is-invalid @enderror" 
                                    id="role" 
                                    name="role" 
                                    required
                                    style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="petugas" {{ old('role', $user->role) === 'petugas' ? 'selected' : '' }}>Petugas</option>
                                <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Anggota</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                            <div class="mt-2 small" style="color: #8b7a6b;">
                                <i class="bi bi-info-circle me-1" style="color: #8b5a2b;"></i>
                                <span class="fw-medium">Admin:</span> Full akses | 
                                <span class="fw-medium">Petugas:</span> Kelola peminjaman | 
                                <span class="fw-medium">Anggota:</span> Peminjam buku
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="d-flex align-items-center gap-3 my-4">
                            <div style="flex: 1; height: 2px; background: linear-gradient(to right, transparent, #8b5a2b, transparent);"></div>
                            <i class="bi bi-key" style="color: #8b5a2b;"></i>
                            <div style="flex: 1; height: 2px; background: linear-gradient(to right, transparent, #8b5a2b, transparent);"></div>
                        </div>

                        <!-- Info Password -->
                        <div class="alert d-flex align-items-start p-4 mb-4" style="background: #f0e7d8; border-left: 4px solid #8b5a2b; border-radius: 16px;">
                            <i class="bi bi-info-circle-fill me-3 fs-5" style="color: #8b5a2b;"></i>
                            <div style="color: #4a3b2c;">
                                <strong class="d-block mb-1">Informasi Password</strong>
                                <span class="small">Kosongkan field password jika tidak ingin mengubah password anggota.</span>
                            </div>
                        </div>

                        <!-- Password Baru dengan icon mata -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                <i class="bi bi-lock me-1" style="color: #8b5a2b;"></i>Password Baru
                            </label>
                            <div class="position-relative">
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Minimal 8 karakter (kosongkan jika tidak diubah)"
                                       style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9; padding-right: 50px;">
                                <span class="position-absolute end-0 top-50 translate-middle-y" 
                                      style="cursor: pointer; padding: 10px 15px; color: #8b7a6b; display: flex; align-items: center;"
                                      onclick="togglePassword('password', 'togglePasswordIcon')"
                                      id="togglePasswordBtn">
                                    <i class="bi bi-eye" id="togglePasswordIcon" style="font-size: 1.2rem;"></i>
                                </span>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password dengan icon mata -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                <i class="bi bi-lock-fill me-1" style="color: #8b5a2b;"></i>Konfirmasi Password Baru
                            </label>
                            <div class="position-relative">
                                <input type="password" 
                                       class="form-control" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       placeholder="Ulangi password baru"
                                       style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9; padding-right: 50px;">
                                <span class="position-absolute end-0 top-50 translate-middle-y" 
                                      style="cursor: pointer; padding: 10px 15px; color: #8b7a6b; display: flex; align-items: center;"
                                      onclick="togglePassword('password_confirmation', 'toggleConfirmIcon')"
                                      id="toggleConfirmBtn">
                                    <i class="bi bi-eye" id="toggleConfirmIcon" style="font-size: 1.2rem;"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Preview Info -->
                        <div class="p-4" style="background: #f8f5f0; border-radius: 16px;">
                            <h6 class="fw-bold mb-3" style="color: #4a3b2c;">
                                <i class="bi bi-eye me-2"></i>Preview Data Anggota
                            </h6>
                            <div class="d-flex align-items-center gap-3" id="previewContainer">
                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 1.2rem;">
                                    <span id="previewInitial">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                </div>
                                <div>
                                    <div class="fw-bold" style="color: #4a3b2c;" id="previewName">{{ $user->name }}</div>
                                    <div style="color: #8b7a6b;" id="previewEmail">{{ $user->email }}</div>
                                    <span class="badge mt-1 py-1 px-2" id="previewRole" style="background: #f0e7d8; color: #8b5a2b;">
                                        <i class="bi bi-person-badge me-1"></i>
                                        <span id="previewRoleText">{{ ucfirst($user->role) }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-3 justify-content-end mt-5 pt-3" style="border-top: 2px solid #f0e7d8;">
                            <a href="{{ route('admin.users.index') }}" class="btn px-5 py-3" style="background: #f0e7d8; color: #8b5a2b; border-radius: 16px; font-weight: 600;">
                                <i class="bi bi-x-lg me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn px-5 py-3" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 16px; font-weight: 600; border: none; box-shadow: 0 10px 20px -5px rgba(139, 90, 43, 0.3);">
                                <i class="bi bi-check-lg me-2"></i>Update Anggota
                            </button>
                        </div>
                    </form>
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

<!-- JavaScript untuk Toggle Password dan Preview -->
<script>
// Fungsi toggle password
function togglePassword(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const toggleIcon = document.getElementById(iconId);
    
    if (passwordInput && toggleIcon) {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        }
    }
}

// Preview data
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const roleSelect = document.getElementById('role');
    
    const previewName = document.getElementById('previewName');
    const previewEmail = document.getElementById('previewEmail');
    const previewRoleText = document.getElementById('previewRoleText');
    const previewInitial = document.getElementById('previewInitial');
    const previewRole = document.getElementById('previewRole');
    
    // Fungsi update preview
    function updatePreview() {
        // Update name
        const name = nameInput.value || '{{ $user->name }}';
        previewName.textContent = name;
        
        // Update initial
        previewInitial.textContent = name.charAt(0).toUpperCase();
        
        // Update email
        previewEmail.textContent = emailInput.value || '{{ $user->email }}';
        
        // Update role
        const role = roleSelect.value || '{{ $user->role }}';
        let roleText = role.charAt(0).toUpperCase() + role.slice(1);
        if (role === 'user') roleText = 'Anggota';
        previewRoleText.textContent = roleText;
        
        // Update role badge color
        previewRole.className = 'badge mt-1 py-1 px-2';
        if (role === 'admin') {
            previewRole.style.background = '#f0e7d8';
            previewRole.style.color = '#8b5a2b';
        } else if (role === 'petugas') {
            previewRole.style.background = '#d4edda';
            previewRole.style.color = '#155724';
        } else {
            previewRole.style.background = '#d1ecf1';
            previewRole.style.color = '#0c5460';
        }
    }
    
    // Event listeners
    nameInput.addEventListener('input', updatePreview);
    emailInput.addEventListener('input', updatePreview);
    roleSelect.addEventListener('change', updatePreview);
    
    // Initial update
    updatePreview();
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

/* Styling untuk toggle password */
.position-relative span {
    cursor: pointer;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
}

.position-relative span:hover {
    color: #8b5a2b !important;
    transform: translateY(-50%) scale(1.1);
}

.bi-eye, .bi-eye-slash {
    transition: all 0.2s ease;
    font-size: 1.2rem;
    pointer-events: none;
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
    transition: all 0.3s ease;
}

#previewContainer:hover {
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