<nav class="navbar navbar-glass mb-4">
    <div class="d-flex align-items-center justify-content-between w-100">
        <div>
            <h5 class="fw-bold text-dark mb-0">@yield('page-title')</h5>
            <small class="text-muted">{{ now()->format('l, d F Y') }}</small>
        </div>

        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-light rounded-circle shadow-sm position-relative" style="width: 40px; height: 40px;">
                <i class="bi bi-bell"></i>
                @if(isset($unread_notifications) && $unread_notifications > 0)
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                @endif
            </button>

            <div class="dropdown">
                <button class="btn btn-light rounded-pill shadow-sm pe-3 ps-1 py-1 d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                    <div class="avatar-circle bg-primary text-white" style="width: 32px; height: 32px; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <span class="fw-semibold small d-none d-md-block">{{ Auth::user()->name ?? 'User' }}</span>
                    <i class="bi bi-chevron-down small text-muted"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 rounded-3 mt-2" style="min-width: 200px;">
                    <li class="px-3 py-2 border-bottom mb-2">
                        <div class="fw-bold text-dark">{{ Auth::user()->name ?? 'User' }}</div>
                        <small class="text-muted">{{ Auth::user()->email ?? '' }}</small>
                    </li>
                    
                    <!-- HAPUS atau COMMENT dulu link yang belum ada routenya -->
                    {{-- 
                    <li>
                        <a class="dropdown-item rounded-2 py-2" href="{{ route('profile.show') }}">
                            <i class="bi bi-person me-2"></i> Profil Saya
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item rounded-2 py-2" href="{{ route('settings.index') }}">
                            <i class="bi bi-gear me-2"></i> Pengaturan
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    --}}
                    
                    <!-- GANTI dengan link sederhana atau yang sudah ada -->
                    <li>
                        <a class="dropdown-item rounded-2 py-2" href="{{ route('admin.alat.index') }}">
                            <i class="bi bi-book me-2"></i> Koleksi Buku
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item rounded-2 py-2" href="{{ route('admin.peminjaman.index') }}">
                            <i class="bi bi-journal-check me-2"></i> Peminjaman
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <!-- FORM LOGOUT -->
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <button type="submit" class="dropdown-item rounded-2 text-danger py-2" onclick="event.preventDefault(); confirmLogout();">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- JavaScript untuk Konfirmasi Logout -->
<script>
function confirmLogout() {
    if (confirm('Apakah Anda yakin ingin keluar dari aplikasi?')) {
        document.getElementById('logout-form').submit();
    }
}
</script>

<style>
.avatar-circle {
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%);
    color: white;
    font-weight: 600;
}

.navbar-glass {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255,255,255,0.3);
    padding: 1rem 1.5rem;
    border-radius: 20px;
    margin: 1rem 1.5rem;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}

.dropdown-item {
    transition: all 0.2s ease;
}

.dropdown-item:hover {
    background: #f8f5f0;
    transform: translateX(5px);
}

.dropdown-item.text-danger:hover {
    background: #fee2e2;
}
</style>