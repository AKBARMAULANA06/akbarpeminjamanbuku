@extends('layouts.guest')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center py-5" 
     style="background: linear-gradient(rgba(70, 40, 20, 0.7), rgba(70, 40, 20, 0.7)), url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') center/cover fixed;">
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card border-0 shadow-lg" style="border-radius: 20px; background: #fef7e9;">
                    <div class="card-body p-5">
                        <!-- Header dengan tema colkat -->
                        <div class="text-center mb-4">
                            <div class="mb-3">
                                <span style="font-size: 3.5rem;">📚</span>
                            </div>
                            <h3 class="fw-bold mb-2" style="color: #6b4423;">Daftar Anggota Perpustakaan</h3>
                            <p class="mb-0" style="color: #8b6b4d;">Mulai petualangan membaca Anda</p>
                        </div>

                        <!-- Form Register -->
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label class="form-label fw-medium" style="color: #6b4423;">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name') }}" 
                                       placeholder="Masukkan nama lengkap" 
                                       style="border-radius: 12px; border: 1.5px solid #d4b594; padding: 12px; background: #fffcf5;"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label fw-medium" style="color: #6b4423;">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" 
                                       placeholder="nama@email.com" 
                                       style="border-radius: 12px; border: 1.5px solid #d4b594; padding: 12px; background: #fffcf5;"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password dengan toggle -->
                            <div class="mb-3">
                                <label class="form-label fw-medium" style="color: #6b4423;">Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           name="password" id="password" 
                                           placeholder="Minimal 8 karakter" 
                                           style="border-radius: 12px; border: 1.5px solid #d4b594; padding: 12px; background: #fffcf5; padding-right: 45px;"
                                           required>
                                    <span class="position-absolute end-0 top-50 translate-middle-y" 
                                          style="cursor: pointer; padding: 10px 15px; color: #8b6b4d;"
                                          onclick="togglePassword('password', 'togglePasswordIcon')">
                                        <i class="bi bi-eye" id="togglePasswordIcon"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Konfirmasi Password dengan toggle -->
                            <div class="mb-4">
                                <label class="form-label fw-medium" style="color: #6b4423;">Konfirmasi Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control" 
                                           name="password_confirmation" id="password_confirmation" 
                                           placeholder="Ulangi password" 
                                           style="border-radius: 12px; border: 1.5px solid #d4b594; padding: 12px; background: #fffcf5; padding-right: 45px;"
                                           required>
                                    <span class="position-absolute end-0 top-50 translate-middle-y" 
                                          style="cursor: pointer; padding: 10px 15px; color: #8b6b4d;"
                                          onclick="togglePassword('password_confirmation', 'toggleConfirmIcon')">
                                        <i class="bi bi-eye" id="toggleConfirmIcon"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Tombol Daftar dengan warna colkat -->
                            <button type="submit" class="btn w-100 mb-4" 
                                    style="background: #8b5a2b; color: white; border-radius: 12px; padding: 12px; border: none; font-weight: 500; transition: all 0.3s;"
                                    onmouseover="this.style.background='#6b431e'" 
                                    onmouseout="this.style.background='#8b5a2b'">
                                <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                            </button>

                            <!-- Link ke Login -->
                            <p class="text-center mb-3" style="color: #8b6b4d;">
                                Sudah punya akun? 
                                <a href="{{ route('login') }}" class="text-decoration-none fw-medium" style="color: #8b5a2b;">
                                    Masuk di sini
                                </a>
                            </p>

                            <!-- Decorative divider -->
                            <div class="text-center">
                                <span style="font-size: 1.2rem; opacity: 0.6; color: #b5926e;">📖 📕 📗 📘 📙</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk toggle password -->
<script>
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
</script>

<!-- CSS Tema Colkat -->
<style>
    /* Warna colkat palette */
    :root {
        --coklat-tua: #6b4423;
        --coklat-sedang: #8b5a2b;
        --coklat-muda: #b5926e;
        --krem: #fef7e9;
        --krem-tua: #fffcf5;
    }

    /* Form styling */
    .form-control:focus {
        border-color: #8b5a2b !important;
        box-shadow: 0 0 0 0.2rem rgba(139, 90, 43, 0.25) !important;
        outline: none;
    }

    /* Card effect */
    .card {
        transition: all 0.3s ease;
        border: 1px solid #e6d5c0 !important;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(107, 68, 35, 0.2) !important;
    }

    /* Password toggle styling */
    .position-relative span {
        cursor: pointer;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border: none;
    }

    .position-relative span:hover {
        color: #6b4423 !important;
        transform: translateY(-50%) scale(1.1);
        transition: all 0.2s ease;
    }

    /* Invalid feedback */
    .invalid-feedback {
        color: #b95b5b;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    /* Book corner effect */
    .card {
        position: relative;
        overflow: hidden;
    }

    .card::before {
        content: '📚';
        position: absolute;
        bottom: 10px;
        right: 10px;
        font-size: 40px;
        opacity: 0.1;
        transform: rotate(-15deg);
        pointer-events: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card-body {
            padding: 2rem !important;
        }
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f0e7d8;
    }

    ::-webkit-scrollbar-thumb {
        background: #8b5a2b;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #6b431e;
    }

    /* Animasi untuk icon mata */
    .bi-eye, .bi-eye-slash {
        transition: all 0.2s ease;
        font-size: 1.2rem;
    }
</style>
@endsection