@extends('layouts.guest')

@section('content')
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1495446815901-a7297e633e8d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') center/cover no-repeat;">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card border-0 shadow-lg" style="border-radius: 20px; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.95);">
            <div class="card-body p-5">
                <!-- Header Sederhana -->
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <span style="font-size: 3.5rem;">📚</span>
                    </div>
                    <h3 class="fw-bold" style="color: #4a3b2c;">Perpustakaana</h3>
                    <p class="text-muted small">Masuk ke akun Anda</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Form Group Sederhana -->
                    <div class="mb-3">
                        <label class="form-label text-secondary small">Email</label>
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus
                               style="border-radius: 12px;">
                        @error('email') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label text-secondary small">Password</label>
                        <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                               name="password" placeholder="••••••••" required
                               style="border-radius: 12px;">
                        @error('password') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <!-- Options -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                            <label class="form-check-label small" for="remember_me">Ingat saya</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="small text-decoration-none" style="color: #8b5a2b;">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <!-- Tombol -->
                    <button type="submit" class="btn w-100 py-2 mb-3" 
                            style="border-radius: 12px; background: #8b5a2b; color: white; font-weight: 500; border: none;">
                        Masuk
                    </button>

                    <!-- Link Daftar -->
                    <p class="text-center small text-muted mb-0">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-decoration-none" style="color: #8b5a2b;">Daftar</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- CSS Sederhana -->
<style>
/* Import font */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

* {
    font-family: 'Inter', sans-serif;
}

/* Form styling */
.form-control {
    border: 1.5px solid #e9ecef;
    padding: 12px 16px;
    transition: all 0.3s;
}

.form-control:focus {
    border-color: #8b5a2b;
    box-shadow: 0 0 0 0.2rem rgba(139, 90, 43, 0.15);
    outline: none;
}

.form-control-lg {
    font-size: 1rem;
}

.form-check-input:checked {
    background-color: #8b5a2b;
    border-color: #8b5a2b;
}

.form-check-input:focus {
    border-color: #8b5a2b;
    box-shadow: 0 0 0 0.2rem rgba(139, 90, 43, 0.15);
}

/* Tombol hover effect */
.btn {
    transition: all 0.3s;
}

.btn:hover {
    background: #6b431e !important;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(139, 90, 43, 0.3);
}

/* Card effect */
.card {
    transition: transform 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

/* Alert styling */
.alert {
    border-radius: 12px;
    border: none;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
}

/* Invalid feedback */
.invalid-feedback {
    font-size: 0.8rem;
    margin-top: 0.25rem;
}

/* Responsive */
@media (max-width: 768px) {
    .card-body {
        padding: 2rem !important;
    }
    
    .container-fluid {
        padding: 1rem;
    }
}

/* Text styling */
.text-secondary {
    color: #6c757d !important;
    font-weight: 500;
    margin-bottom: 0.3rem;
}

/* Link styling */
a {
    transition: all 0.2s;
}

a:hover {
    color: #6b431e !important;
    text-decoration: underline !important;
}

/* Button close styling */
.btn-close:focus {
    box-shadow: 0 0 0 0.2rem rgba(139, 90, 43, 0.15);
}
</style>
@endsection