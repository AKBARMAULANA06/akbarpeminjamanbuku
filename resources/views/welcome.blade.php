<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKK Perpus Sekolah · </title>
    
    <!-- Font sederhana: sistem default -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Favicon / icon buku untuk tab browser -->
    <link rel="icon" type="image/png" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23dbb48b'%3E%3Cpath d='M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z'/%3E%3C/svg%3E">
    
    <!-- Alternatif: pakai font awesome buku (opsional, tapi kita sudah pakai bootstrap icon) -->
    <!-- Tetap pakai bootstrap icon, favicon sudah buku -->
    
    <style>
        /* HAPUS SCROLL - fixed, tidak bisa scroll */
        html, body {
            height: 100%;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        body {
            background: #4a3422 url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?q=80&w=1856&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover;
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            position: relative;
            height: 100%;
            overflow: hidden;
        }

        /* overlay coklat gelap */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(59, 40, 26, 0.75);  /* coklat tua transparan */
            z-index: 0;
            pointer-events: none;
        }

        .hero-simple {
            position: relative;
            z-index: 2;
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            padding: 0;
            margin: 0;
            overflow: hidden;
        }

        .container {
            height: auto;
            max-height: 100vh;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            overflow: hidden;     
        }

        /* konten coklat muda/karamel - tanpa putih */
        .card-transparent {
            background: rgba(139, 94, 60, 0.85);     /* coklat medium transparan */
            backdrop-filter: blur(4px);
            border-radius: 2rem;
            padding: 1.5rem 2rem;
            box-shadow: 0 20px 35px -8px rgba(30, 20, 10, 0.6);
            border: 1px solid rgba(205, 157, 109, 0.5);
            max-height: 95vh;
            overflow-y: auto;
        }

        .card-transparent::-webkit-scrollbar {
            width: 0;
            background: transparent;
        }

        .logo-bunder {
            width: 60px;
            height: 60px;
            background: #a77b54;    /* coklat keemasan */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f7e3cc;
            font-size: 28px;
            box-shadow: 0 8px 12px rgba(0,0,0,0.3);
            border: 1px solid #dbb48b;
        }

        h1 {
            font-size: 2.8rem;
            font-weight: 700;
            color: #fbe9d9;        /* krem kecoklatan */
            line-height: 1.2;
            letter-spacing: -0.02em;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px #2f1e12;
        }

        h1 span {
            background: #b48b60;    /* coklat agak terang */
            padding: 0.1rem 0.8rem;
            display: inline-block;
            border-radius: 60px;
            font-size: 2rem;
            font-weight: 500;
            color: #241a12;
            margin-top: 0.2rem;
            box-shadow: inset 0 -3px 0 #6b4d33;
            border: 1px solid #e7c29f;
        }

        .sub-simple {
            background: #9d7a5a;     /* coklat susu */
            color: #fef1e3;
            padding: 0.5rem 1.3rem;
            border-radius: 40px;
            font-size: 1rem;
            display: inline-block;
            border: 1px solid #dbb58b;
            margin-top: 0.2rem;
            margin-bottom: 1rem;
            font-weight: 400;
            text-shadow: 0 1px 2px #3d2c1b;
        }

        .btn-simple-1 {
            background: #946b42;     /* coklat tua */
            border: none;
            color: #f8ebdd;
            padding: 0.6rem 1.8rem;
            border-radius: 40px;
            font-weight: 500;
            box-shadow: 0 6px 0 #523e2b;
            transition: 0.1s ease;
            border: 1px solid #c99e73;
        }

        .btn-simple-1:hover {
            background: #b28559;
            transform: translateY(-2px);
            box-shadow: 0 8px 0 #523e2b;
            color: white;
        }

        .btn-simple-2 {
            background: transparent;
            border: 2px solid #dbb48b;
            color: #fae8d7;
            padding: 0.6rem 1.8rem;
            border-radius: 40px;
            font-weight: 500;
            transition: 0.2s;
            text-shadow: 0 1px 2px #2f1f13;
        }

        .btn-simple-2:hover {
            background: #c49d77;
            border-color: #eecdaf;
            color: #261c12;
        }

        .stat-blok {
            background: #836e54;     /* coklat keabuan */
            border-radius: 1.5rem;
            padding: 0.8rem 0.4rem;
            text-align: center;
            box-shadow: 0 6px 0 #5f4b38;
            border: 1px solid #ccb094;
        }

        .stat-angka {
            font-size: 1.7rem;
            font-weight: 700;
            color: #f5e2cf;
            line-height: 1;
            text-shadow: 0 2px 3px #392c1f;
        }

        .stat-label {
            color: #eddccb;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .fitur-simple {
            background: rgba(115, 78, 48, 0.9);    /* coklat gelap transparan */
            backdrop-filter: blur(2px);
            border-radius: 1.5rem;
            padding: 1rem 1.2rem;
            margin-bottom: 0.8rem;
            border: 1px solid #b48f6b;
            transition: 0.2s;
        }

        .fitur-simple:last-child {
            margin-bottom: 0;
        }

        .fitur-simple:hover {
            background: #8f6e50;     /* coklat medium */
            border-color: #e5bf9a;
        }

        .fitur-icon {
            width: 42px;
            height: 42px;
            background: #b58f6b;     /* coklat agak terang */
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #2f1f13;
            margin-bottom: 0.5rem;
            border: 1px solid #ebc9a8;
        }

        .fitur-simple h5 {
            font-size: 1.1rem;
            margin-bottom: 0.2rem;
            color: #fbebdb;
            font-weight: 600;
        }

        .fitur-simple p {
            font-size: 0.9rem;
            margin-bottom: 0;
            color: #e9d6c2;
        }

        .footer-quote {
            margin-top: 1rem;
            color: #f7dbbf;
            border-left: 5px solid #c9a27b;
            padding-left: 1rem;
            background: rgba(80, 55, 35, 0.6);
            border-radius: 0 1rem 1rem 0;
            font-size: 0.95rem;
            backdrop-filter: blur(2px);
        }

        /* teks kecil tambahan */
        span[style*="color"] {
            color: #edd3bb !important;
        }

        /* responsif kecil */
        @media (max-width: 768px) {
            h1 { font-size: 2.2rem; }
            h1 span { font-size: 1.6rem; }
            .card-transparent { padding: 1.2rem; }
            .fitur-simple { padding: 0.8rem; }
        }

        /* sembunyiin scrollbar */
        * {
            scrollbar-width: none;
        }
        
        /* efek buku kecil di background (dekoratif) */
        .book-bg-decor {
            position: fixed;
            bottom: 20px;
            right: 30px;
            font-size: 100px;
            opacity: 0.1;
            color: #dbb48b;
            transform: rotate(-10deg);
            z-index: 1;
            pointer-events: none;
        }
        
        .book-bg-decor-left {
            position: fixed;
            top: 50px;
            left: 30px;
            font-size: 80px;
            opacity: 0.08;
            color: #e5c9aa;
            transform: rotate(15deg);
            z-index: 1;
            pointer-events: none;
        }
    </style>
</head>
<body>

<!-- dekorasi icon buku di background -->
<div class="book-bg-decor">
    <i class="bi bi-journal-bookmark-fill"></i>
</div>
<div class="book-bg-decor-left">
    <i class="bi bi-book"></i>
</div>

<div class="hero-simple">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="card-transparent">
                    <!-- header kecil -->
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="logo-bunder">
                            <i class="bi bi-book-half"></i>
                        </div>
                        <span style="font-size: 1.3rem; font-weight: 400; color: #f7ddc7;">UKK Perpustakaan</span>
                    </div>

                    <!-- konten 2 kolom -->
                    <div class="row g-3 align-items-center">
                        <!-- kiri -->
                        <div class="col-md-6">
                            <h1>
                                Manajemen peminjaman
                                <span>buku</span>
                            </h1>

                            <div class="sub-simple">
                                <i class="bi bi-check-circle-fill me-1" style="color:#f3cdab;"></i>
                                catat peminjaman, data anggota, koleksi buku
                            </div>

                            <div class="d-flex gap-3 flex-wrap">
                                <a href="{{ route('login') }}" class="btn btn-simple-1">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-simple-2">
                                    <i class="bi bi-person-plus me-2"></i>Daftar
                                </a>
                            </div>

                            <!-- statistik -->
                            <div class="row mt-4 g-2">
                                <div class="col-4">
                                    <div class="stat-blok">
                                        <div class="stat-angka">
                                            @php
                                                $totalBuku = class_exists('App\Models\Buku') ? \App\Models\Buku::count() : (class_exists('App\Models\Book') ? \App\Models\Book::count() : 146);
                                            @endphp
                                            {{ $totalBuku }}
                                        </div>
                                        <div class="stat-label">Buku</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-blok">
                                        <div class="stat-angka">
                                            @php
                                                $totalAnggota = class_exists('App\Models\Anggota') ? \App\Models\Anggota::count() : (class_exists('App\Models\User') ? \App\Models\User::count() : 219);
                                            @endphp
                                            {{ $totalAnggota }}
                                        </div>
                                        <div class="stat-label">Anggota</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-blok">
                                        <div class="stat-angka">
                                            @php
                                                $totalPinjam = class_exists('App\Models\Peminjaman') ? \App\Models\Peminjaman::count() : (class_exists('App\Models\Loan') ? \App\Models\Loan::count() : 589);
                                            @endphp
                                            {{ $totalPinjam }}
                                        </div>
                                        <div class="stat-label">Transaksi</div>
                                    </div>
                                </div>
                            </div>

                            <!-- kutipan kecil - DIGANTI -->
                            <div class="footer-quote mt-3">
                                <i class="bi bi-quote"></i>  baca buku, buka jendela dunia.
                            </div>
                        </div>

                        <!-- kanan: fitur -->
                        <div class="col-md-6">
                            <div class="fitur-simple">
                                <div class="fitur-icon">
                                    <i class="bi bi-arrow-repeat"></i>
                                </div>
                                <h5 class="fw-semibold">Peminjaman & pengembalian</h5>
                                <p class="">Catat siapa pinjam, kapan kembali + denda otomatis.</p>
                            </div>
                            <div class="fitur-simple">
                                <div class="fitur-icon">
                                    <i class="bi bi-collection"></i>
                                </div>
                                <h5 class="fw-semibold">Katalog koleksi</h5>
                                <p class="">Data buku, stok, genre, pengarang. input mudah.</p>
                            </div>
                            <div class="fitur-simple">
                                <div class="fitur-icon">
                                    <i class="bi bi-person-badge"></i>
                                </div>
                                <h5 class="fw-semibold">Manajemen anggota</h5>
                                <p class="">Data anggota + riwayat peminjaman tiap siswa.</p>
                            </div>
                            <div class="fitur-simple">
                                <div class="fitur-icon">
                                    <i class="bi bi-file-text"></i>
                                </div>
                                <h5 class="fw-semibold">Laporan sederhana</h5>
                                <p class="">Rekap peminjaman, buku favorit.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Halaman dengan tema coklat, icon buku di favicon & background -->
</body>
</html>