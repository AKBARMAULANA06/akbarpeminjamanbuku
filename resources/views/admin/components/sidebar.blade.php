<nav class="sidebar" style="background: linear-gradient(180deg, #4a3b2c 0%, #2c1f14 100%); color: #e8d9c8; width: 280px; height: 100vh; position: fixed; left: 0; top: 0; overflow-y: auto; box-shadow: 5px 0 30px rgba(0,0,0,0.3); z-index: 1000;">
    <!-- Sidebar Header -->
    <div class="sidebar-header p-4" style="border-bottom: 2px solid #8b5a2b;">
        <div class="d-flex align-items-center gap-3">
            <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-journal-bookmark-fill fs-4" style="color: #f0e7d8;"></i>
            </div>
            <div>
                <h5 class="mb-0 fw-bold" style="color: #f0e7d8;">Pustaka</h5>
                <small style="color: #c9b9a8;">Admin Panel</small>
            </div>
        </div>
    </div>

    <!-- Sidebar Body -->
    <div class="sidebar-body p-3">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2 mb-1 rounded-3 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
           style="color: {{ request()->routeIs('admin.dashboard') ? '#f0e7d8' : '#c9b9a8' }}; background: {{ request()->routeIs('admin.dashboard') ? '#8b5a2b' : 'transparent' }}; text-decoration: none;">
            <i class="bi bi-grid-1x2 fs-5" style="width: 20px;"></i>
            <span>Dashboard</span>
        </a>

        <!-- Master Data -->
        <div class="mt-3 mb-2 px-3" style="color: #8b5a2b; font-size: 0.75rem; font-weight: 600;">MASTER DATA</div>
        
        <a href="{{ route('admin.kategori.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2 mb-1 rounded-3 {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}"
           style="color: {{ request()->routeIs('admin.kategori.*') ? '#f0e7d8' : '#c9b9a8' }}; background: {{ request()->routeIs('admin.kategori.*') ? '#8b5a2b' : 'transparent' }}; text-decoration: none;">
            <i class="bi bi-tags fs-5" style="width: 20px;"></i>
            <span>Kategori Buku</span>
        </a>
        
        <a href="{{ route('admin.alat.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2 mb-1 rounded-3 {{ request()->routeIs('admin.alat.*') ? 'active' : '' }}"
           style="color: {{ request()->routeIs('admin.alat.*') ? '#f0e7d8' : '#c9b9a8' }}; background: {{ request()->routeIs('admin.alat.*') ? '#8b5a2b' : 'transparent' }}; text-decoration: none;">
            <i class="bi bi-book-half fs-5" style="width: 20px;"></i>
            <span>Koleksi Buku</span>
        </a>
        
        <a href="{{ route('admin.users.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2 mb-1 rounded-3 {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
           style="color: {{ request()->routeIs('admin.users.*') ? '#f0e7d8' : '#c9b9a8' }}; background: {{ request()->routeIs('admin.users.*') ? '#8b5a2b' : 'transparent' }}; text-decoration: none;">
            <i class="bi bi-people fs-5" style="width: 20px;"></i>
            <span>Manajemen Anggota</span>
        </a>

        <!-- Transaksi -->
        <div class="mt-3 mb-2 px-3" style="color: #8b5a2b; font-size: 0.75rem; font-weight: 600;">TRANSAKSI</div>
        
        <a href="{{ route('admin.peminjaman.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2 mb-1 rounded-3 {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}"
           style="color: {{ request()->routeIs('admin.peminjaman.*') ? '#f0e7d8' : '#c9b9a8' }}; background: {{ request()->routeIs('admin.peminjaman.*') ? '#8b5a2b' : 'transparent' }}; text-decoration: none;">
            <i class="bi bi-arrow-left-right fs-5" style="width: 20px;"></i>
            <span>Peminjaman</span>
        </a>
        
        <a href="{{ route('admin.pengembalian.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2 mb-1 rounded-3 {{ request()->routeIs('admin.pengembalian.*') ? 'active' : '' }}"
           style="color: {{ request()->routeIs('admin.pengembalian.*') ? '#f0e7d8' : '#c9b9a8' }}; background: {{ request()->routeIs('admin.pengembalian.*') ? '#8b5a2b' : 'transparent' }}; text-decoration: none;">
            <i class="bi bi-arrow-return-left fs-5" style="width: 20px;"></i>
            <span>Pengembalian</span>
        </a>
        
        <a href="{{ route('admin.transaksi.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2 mb-1 rounded-3 {{ request()->routeIs('admin.transaksi.*') ? 'active' : '' }}"
           style="color: {{ request()->routeIs('admin.transaksi.*') ? '#f0e7d8' : '#c9b9a8' }}; background: {{ request()->routeIs('admin.transaksi.*') ? '#8b5a2b' : 'transparent' }}; text-decoration: none;">
            <i class="bi bi-file-text fs-5" style="width: 20px;"></i>
            <span>Laporan</span>
        </a>
    </div>

    <!-- Sidebar Footer dengan Hak Cipta -->
    <div class="sidebar-footer" style="border-top: 1px solid #8b5a2b; position: absolute; bottom: 0; left: 0; right: 0; background: #2c1f14;">
        <!-- Info User -->
        <div class="p-3">
            <div class="d-flex align-items-center gap-3">
                <div style="width: 38px; height: 38px; background: #8b5a2b; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #f0e7d8; font-weight: 600;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div style="line-height: 1.3;">
                    <div style="color: #f0e7d8; font-size: 0.85rem; font-weight: 600;">{{ Auth::user()->name }}</div>
                    <div style="color: #c9b9a8; font-size: 0.7rem;">{{ ucfirst(Auth::user()->role) }}</div>
                </div>
            </div>
        </div>
        
        <!-- Hak Cipta -->
        <div class="text-center py-2" style="background: rgba(0,0,0,0.2); border-top: 1px solid #5a3e2b;">
            <small style="color: #a58e7a; font-size: 0.65rem;">
                © {{ date('Y') }} Akbar . All rights reserved.
            </small>
        </div>
    </div>
</nav>

<style>
/* Hover effect sederhana */
.sidebar .nav-link:hover {
    background: #5a3e2b !important;
    color: #f0e7d8 !important;
}

/* Custom scrollbar minimal */
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

/* Hilangkan semua animasi */
* {
    animation: none !important;
    transition: none !important;
}
</style>