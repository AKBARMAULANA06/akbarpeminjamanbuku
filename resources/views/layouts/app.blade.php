<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Dashboard')</title>

<!-- Favicon Buku -->
<link rel="icon" type="image/png" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='%238b5a2b' d='M14 2v13h-10.5c-.829 0-1.5-.671-1.5-1.5s.671-1.5 1.5-1.5h9.5v-11h-9c-1.103 0-2 .897-2 2v10.5c0 1.378 1.122 2.5 2.5 2.5h11.5v-14h-2z'/%3E%3Cpath fill='%238b5a2b' d='M3 1v12h9v-12h-9zm7 10h-5v-1h5v1zm0-2h-5v-1h5v1zm0-2h-5v-1h5v1z'/%3E%3C/svg%3E">

<!-- Apple Touch Icon -->
<link rel="apple-touch-icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='%238b5a2b' d='M14 2v13h-10.5c-.829 0-1.5-.671-1.5-1.5s.671-1.5 1.5-1.5h9.5v-11h-9c-1.103 0-2 .897-2 2v10.5c0 1.378 1.122 2.5 2.5 2.5h11.5v-14h-2z'/%3E%3Cpath fill='%238b5a2b' d='M3 1v12h9v-12h-9zm7 10h-5v-1h5v1zm0-2h-5v-1h5v1zm0-2h-5v-1h5v1z'/%3E%3C/svg%3E">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="{{ asset('css/modern-dashboard.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    <div id="app-content">
        @yield('sidebar')
        
        <div id="page-content">
            @yield('navbar')
            
            <main>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Global Delete Confirmation
        document.addEventListener('DOMContentLoaded', function() {
            document.body.addEventListener('submit', function(e) {
                if (e.target && e.target.classList.contains('delete-form')) {
                    e.preventDefault();
                    const form = e.target;
                    
                    Swal.fire({
                        title: 'Yakin hapus data ini?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        background: '#ffffff',
                        customClass: {
                            popup: 'rounded-4 shadow-lg border-0',
                            confirmButton: 'btn btn-danger px-4 py-2 rounded-3',
                            cancelButton: 'btn btn-secondary px-4 py-2 rounded-3 ms-2'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
                
                // Approve Confirmation
                if (e.target && e.target.classList.contains('approve-form')) {
                    e.preventDefault();
                    const form = e.target;
                    
                    Swal.fire({
                        title: 'Setujui Peminjaman?',
                        text: "Status akan berubah menjadi Active/Sedang Dipinjam.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#10b981', // Emerald
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Setujui!',
                        cancelButtonText: 'Batal',
                        background: '#ffffff',
                        customClass: {
                            popup: 'rounded-4 shadow-lg border-0',
                            confirmButton: 'btn btn-success px-4 py-2 rounded-3',
                            cancelButton: 'btn btn-secondary px-4 py-2 rounded-3 ms-2'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }

                // Reject Confirmation
                if (e.target && e.target.classList.contains('reject-form')) {
                    e.preventDefault();
                    const form = e.target;
                    
                    Swal.fire({
                        title: 'Tolak Peminjaman?',
                        text: "Peminjaman akan dibatalkan permanen.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444', 
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Tolak!',
                        cancelButtonText: 'Batal',
                        background: '#ffffff',
                        customClass: {
                            popup: 'rounded-4 shadow-lg border-0',
                            confirmButton: 'btn btn-danger px-4 py-2 rounded-3',
                            cancelButton: 'btn btn-secondary px-4 py-2 rounded-3 ms-2'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });

            // Flash Message Toast
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#ffffff'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: "{{ session('error') }}",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    background: '#ffffff'
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: '<ul class="text-start" style="list-style: none; padding: 0;">@foreach($errors->all() as $error)<li>⚠️ {{ $error }}</li>@endforeach</ul>',
                    confirmButtonText: 'Tutup',
                    confirmButtonColor: '#d33'
                });
            @endif
        });
    </script>
</body>
</html>
