<nav class="sidebar" style="background: linear-gradient(180deg, #4a3b2c 0%, #2c1f14 100%); color: #e8d9c8; width: 280px; height: 100vh; position: fixed; left: 0; top: 0; overflow-y: auto; box-shadow: 5px 0 30px rgba(0,0,0,0.3); z-index: 1000;">
    <!-- Sidebar Header -->
    <div class="sidebar-header p-4" style="border-bottom: 2px solid #8b5a2b;">
        <div class="d-flex align-items-center gap-3">
            <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(0,0,0,0.3);">
                <i class="bi bi-journal-bookmark-fill fs-4" style="color: #f0e7d8;"></i>
            </div>
            <div>
                <h5 class="mb-0 fw-bold" style="color: #f0e7d8; font-family: 'Playfair Display', serif;">Pustaka</h5>
                <small style="color: #c9b9a8;">Petugas Perpustakaan</small>
            </div>
        </div>
    </div>

    <div class="sidebar-body p-3">
        <!-- Navigasi Utama -->
        <div class="nav-section mb-2 px-3" style="color: #8b5a2b; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
            <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem; color: #8b5a2b;"></i> Utama
        </div>
        
        <a href="{{ route('petugas.dashboard') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2 mb-1 rounded-3 {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}" 
           style="color: {{ request()->routeIs('petugas.dashboard') ? '#f0e7d8' : '#c9b9a8' }}; background: {{ request()->routeIs('petugas.dashboard') ? '#8b5a2b' : 'transparent' }}; text-decoration: none;">
            <i class="bi bi-grid-1x2 fs-5" style="width: 20px;"></i>
            <span class="fw-medium">Dashboard</span>
            @if(request()->routeIs('petugas.dashboard'))
                <i class="bi bi-bookmark-fill ms-auto" style="font-size: 0.8rem; color: #f0e7d8;"></i>
            @endif
        </a>

        <!-- Navigasi Master Data -->
        <div class="nav-section mt-4 mb-2 px-3" style="color: #8b5a2b; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
            <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem; color: #8b5a2b;"></i> Master Data
        </div>
        
        <a href="{{ route('petugas.kategori.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2 mb-1 rounded-3 {{ request()->routeIs('petugas.kategori.*') ? 'active' : '' }}"
           style="color: {{ request()->routeIs('petugas.kategori.*') ? '#f0e7d8' : '#c9b9a8' }}; background: {{ request()->routeIs('petugas.kategori.*') ? '#8b5a2b' : 'transparent' }}; text-decoration: none;">
            <i class="bi bi-tags fs-5" style="width: 20px;"></i>
            <span class="fw-medium">Kategori Buku</span>
            @if(request()->routeIs('petugas.kategori.*'))
                <i class="bi bi-bookmark-fill ms-auto" style="font-size: 0.8rem; color: #f0e7d8;"></i>
            @endif
        </a>
        
        <a href="{{ route('petugas.alat.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2 mb-1 rounded-3 {{ request()->routeIs('petugas.alat.*') ? 'active' : '' }}"
           style="color: {{ request()->routeIs('petugas.alat.*') ? '#f0e7d8' : '#c9b9a8' }}; background: {{ request()->routeIs('petugas.alat.*') ? '#8b5a2b' : 'transparent' }}; text-decoration: none;">
            <i class="bi bi-book-half fs-5" style="width: 20px;"></i>
            <span class="fw-medium">Koleksi Buku</span>
            @if(request()->routeIs('petugas.alat.*'))
                <i class="bi bi-bookmark-fill ms-auto" style="font-size: 0.8rem; color: #f0e7d8;"></i>
            @endif
        </a>

        <!-- Navigasi Operasional -->
        <div class="nav-section mt-4 mb-2 px-3" style="color: #8b5a2b; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
            <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem; color: #8b5a2b;"></i> Operasional
        </div>
        
        <a href="{{ route('petugas.peminjaman.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2 mb-1 rounded-3 {{ request()->routeIs('petugas.peminjaman.*') ? 'active' : '' }}"
           style="color: {{ request()->routeIs('petugas.peminjaman.*') ? '#f0e7d8' : '#c9b9a8' }}; background: {{ request()->routeIs('petugas.peminjaman.*') ? '#8b5a2b' : 'transparent' }}; text-decoration: none;">
            <i class="bi bi-arrow-left-right fs-5" style="width: 20px;"></i>
            <span class="fw-medium">Peminjaman</span>
            @if(request()->routeIs('petugas.peminjaman.*'))
                <i class="bi bi-bookmark-fill ms-auto" style="font-size: 0.8rem; color: #f0e7d8;"></i>
            @endif
        </a>
        
        <a href="{{ route('petugas.pengembalian.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2 mb-1 rounded-3 {{ request()->routeIs('petugas.pengembalian.*') ? 'active' : '' }}"
           style="color: {{ request()->routeIs('petugas.pengembalian.*') ? '#f0e7d8' : '#c9b9a8' }}; background: {{ request()->routeIs('petugas.pengembalian.*') ? '#8b5a2b' : 'transparent' }}; text-decoration: none;">
            <i class="bi bi-arrow-return-left fs-5" style="width: 20px;"></i>
            <span class="fw-medium">Pengembalian</span>
            @if(request()->routeIs('petugas.pengembalian.*'))
                <i class="bi bi-bookmark-fill ms-auto" style="font-size: 0.8rem; color: #f0e7d8;"></i>
            @endif
        </a>
        
        <a href="{{ route('petugas.transaksi.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2 mb-1 rounded-3 {{ request()->routeIs('petugas.transaksi.*') ? 'active' : '' }}"
           style="color: {{ request()->routeIs('petugas.transaksi.*') ? '#f0e7d8' : '#c9b9a8' }}; background: {{ request()->routeIs('petugas.transaksi.*') ? '#8b5a2b' : 'transparent' }}; text-decoration: none;">
            <i class="bi bi-file-earmark-text fs-5" style="width: 20px;"></i>
            <span class="fw-medium">Laporan Transaksi</span>
            @if(request()->routeIs('petugas.transaksi.*'))
                <i class="bi bi-bookmark-fill ms-auto" style="font-size: 0.8rem; color: #f0e7d8;"></i>
            @endif
        </a>
    </div>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer" style="border-top: 1px solid #8b5a2b; position: absolute; bottom: 0; left: 0; right: 0; background: #2c1f14;">
        <div class="p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="d-flex align-items-center justify-content-center" 
                     style="width: 40px; height: 40px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 10px; color: #f0e7d8; font-weight: 600; font-size: 1rem; box-shadow: 0 3px 8px rgba(0,0,0,0.3);">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div style="line-height: 1.3;">
                    <div style="color: #f0e7d8; font-size: 0.85rem; font-weight: 600;">{{ Auth::user()->name }}</div>
                    <div style="color: #c9b9a8; font-size: 0.7rem;">
                        <i class="bi bi-person-badge me-1"></i>Petugas
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center py-2" style="border-top: 1px solid rgba(139, 90, 43, 0.3);">
            <small style="color: #8b7a6b; font-size: 0.7rem;">
                <i class="bi bi-c-circle me-1" style="font-size: 0.6rem;"></i>
                {{ date('Y') }} Akbar. All rights reserved.
            </small>
        </div>
    </div>
</nav>

<style>
/* Hanya untuk sidebar saja yang tanpa animasi */
.sidebar * {
    animation: none !important;
    transition: none !important;
}

.sidebar .nav-link {
    transition: background 0.2s ease !important; /* Izinkan transisi hover */
}

.sidebar .nav-link:hover {
    background: #5a3e2b !important;
    color: #f0e7d8 !important;
}

/* Custom scrollbar */
.sidebar::-webkit-scrollbar {
    width: 4px;
}

.sidebar::-webkit-scrollbar-track {
    background: #2c1f14;
}

.sidebar::-webkit-scrollbar-thumb {
    background: #8b5a2b;
    border-radius: 4px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: #a8753a;
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        width: 240px;
    }
}

/* Hover effect untuk hak cipta */
.sidebar-footer .text-center:hover small {
    color: #c9b9a8 !important;
    transition: color 0.3s ease;
}
</style>