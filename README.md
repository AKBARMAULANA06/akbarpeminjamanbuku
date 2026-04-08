<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pustaka Admin Panel - Dashboard Perpustakaan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background: #f5efe7;
            display: flex;
            min-height: 100vh;
        }

        /* ========= SIDEBAR - WARNA COKLAT TUA ========= */
        .sidebar {
            width: 260px;
            background: #5c3e2b;
            color: #f5e6d3;
            position: fixed;
            height: 100vh;
            transition: all 0.3s ease;
            z-index: 100;
            overflow-y: auto;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.1);
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            margin-bottom: 24px;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            background: #d4a373;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .logo-text {
            font-size: 20px;
            font-weight: 700;
            color: white;
            white-space: nowrap;
            letter-spacing: 0.5px;
        }

        .sidebar.collapsed .logo-text,
        .sidebar.collapsed .menu-text {
            display: none;
        }

        .nav-section {
            padding: 0 16px;
            margin-bottom: 28px;
        }

        .section-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
            color: #c9a87b;
            margin-bottom: 14px;
            padding-left: 12px;
        }

        .sidebar.collapsed .section-title {
            text-align: center;
            font-size: 9px;
            padding-left: 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 6px;
            cursor: pointer;
            transition: all 0.2s;
            color: #e8d5bc;
        }

        .menu-item i {
            width: 22px;
            font-size: 1.1rem;
            text-align: center;
        }

        .menu-item:hover {
            background: #7a5538;
            color: white;
        }

        .menu-item.active {
            background: #d4a373;
            color: white;
            box-shadow: 0 4px 10px rgba(212, 163, 115, 0.3);
        }

        /* ========= MAIN CONTENT ========= */
        .main-panel {
            flex: 1;
            margin-left: 260px;
            transition: margin-left 0.3s ease;
        }

        .main-panel.expanded {
            margin-left: 70px;
        }

        /* Top Bar */
        .top-bar {
            background: white;
            padding: 12px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .menu-toggle {
            background: #f5efe7;
            border: none;
            font-size: 1.2rem;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            cursor: pointer;
            color: #5c3e2b;
        }

        .menu-toggle:hover {
            background: #e8ddcf;
        }

        .page-head {
            font-size: 1.4rem;
            font-weight: 700;
            color: #5c3e2b;
            margin-left: 16px;
        }

        .right-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .admin-badge {
            background: #f5efe7;
            padding: 6px 16px;
            border-radius: 30px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #5c3e2b;
        }

        .avatar {
            background: #d4a373;
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }

        /* Content Area */
        .dashboard-content {
            padding: 28px;
        }

        /* Welcome Banner - warna coklat */
        .welcome-card {
            background: linear-gradient(135deg, #5c3e2b 0%, #4a3222 100%);
            border-radius: 20px;
            padding: 24px 32px;
            margin-bottom: 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 6px 14px rgba(92, 62, 43, 0.2);
        }

        .welcome-title {
            font-size: 1.6rem;
            font-weight: 700;
        }

        .date-badge {
            background: rgba(212, 163, 115, 0.25);
            padding: 8px 20px;
            border-radius: 40px;
            font-weight: 500;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(212, 163, 115, 0.5);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 22px;
            margin-bottom: 28px;
        }

        .stat-block {
            background: white;
            border-radius: 20px;
            padding: 22px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: all 0.2s;
            border: 1px solid #e8ddd0;
        }

        .stat-block:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }

        .stat-header span:first-child {
            color: #8b6b4f;
            font-weight: 500;
            font-size: 14px;
        }

        .stat-icon {
            font-size: 28px;
            color: #d4a373;
        }

        .stat-number {
            font-size: 36px;
            font-weight: 800;
            color: #5c3e2b;
            margin-bottom: 8px;
        }

        .stat-trend {
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .trend-up { color: #10b981; }
        .trend-down { color: #ef4444; }

        /* Double Section */
        .double-section {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 24px;
            margin-bottom: 28px;
        }

        .quick-actions-card, .recent-card {
            background: white;
            border-radius: 20px;
            padding: 22px 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid #e8ddd0;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #5c3e2b;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .action-btn {
            background: #fefaf5;
            border: 1px solid #e8ddd0;
            padding: 14px 18px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            gap: 14px;
            font-weight: 600;
            color: #5c3e2b;
            transition: all 0.2s;
            cursor: pointer;
        }

        .action-btn i {
            width: 24px;
            color: #d4a373;
            font-size: 1.1rem;
        }

        .action-btn:hover {
            background: #f5efe7;
            border-color: #d4a373;
            transform: translateX(5px);
        }

        .activity-list {
            list-style: none;
        }

        .activity-item {
            display: flex;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid #f0e8df;
        }

        .activity-icon {
            width: 38px;
            height: 38px;
            background: #f5efe7;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d4a373;
        }

        .activity-text {
            font-weight: 500;
            margin-bottom: 5px;
            color: #5c3e2b;
        }

        .activity-time {
            font-size: 11px;
            color: #a88b6e;
        }

        /* Transaction Card */
        .transaction-card {
            background: white;
            border-radius: 20px;
            padding: 22px;
            border: 1px solid #e8ddd0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .badge-pending {
            background: #f5efe7;
            color: #5c3e2b;
            border-radius: 30px;
            padding: 4px 12px;
            font-size: 12px;
            font-weight: 600;
        }

        hr {
            margin: 18px 0;
            border-color: #f0e8df;
        }

        .loan-status {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 16px;
        }

        .lihat-link {
            color: #d4a373;
            cursor: pointer;
            font-weight: 600;
        }

        .toast-msg {
            margin-top: 16px;
            font-size: 13px;
            color: #d4a373;
            font-weight: 500;
        }

        @media (max-width: 1100px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .double-section { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); position: fixed; }
            .sidebar.mobile-open { transform: translateX(0); }
            .main-panel { margin-left: 0 !important; }
            .stats-grid { grid-template-columns: 1fr; }
            .welcome-card { flex-direction: column; align-items: flex-start; gap: 12px; }
        }
    </style>
</head>
<body>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo-area">
            <div class="logo-icon"><i class="fas fa-chalkboard-user"></i></div>
            <div class="logo-text">Pustaka Admin</div>
        </div>
    </div>

    <div class="nav-section">
        <div class="section-title"><i class="fas fa-database"></i> MASTER DATA</div>
        <div class="menu-item" data-menu="kategori">
            <i class="fas fa-tags"></i><span class="menu-text">Kategori Buku</span>
        </div>
        <div class="menu-item" data-menu="koleksi">
            <i class="fas fa-book"></i><span class="menu-text">Koleksi Buku</span>
        </div>
        <div class="menu-item" data-menu="anggota">
            <i class="fas fa-users"></i><span class="menu-text">Manajemen Anggota</span>
        </div>
    </div>

    <div class="nav-section">
        <div class="section-title"><i class="fas fa-exchange-alt"></i> TRANSAKSI</div>
        <div class="menu-item" data-menu="peminjaman">
            <i class="fas fa-hand-holding-heart"></i><span class="menu-text">Peminjaman</span>
        </div>
        <div class="menu-item" data-menu="pengembalian">
            <i class="fas fa-undo-alt"></i><span class="menu-text">Pengembalian</span>
        </div>
        <div class="menu-item" data-menu="laporan">
            <i class="fas fa-chart-line"></i><span class="menu-text">Laporan</span>
        </div>
    </div>
</aside>

<main class="main-panel" id="mainPanel">
    <div class="top-bar">
        <div style="display: flex; align-items: center;">
            <button class="menu-toggle" id="toggleBtn"><i class="fas fa-bars"></i></button>
            <div class="page-head">Dashboard</div>
        </div>
        <div class="right-actions">
            <div class="admin-badge">
                <i class="fas fa-user-cog"></i> <span>Admin</span>
            </div>
            <div class="avatar">AD</div>
        </div>
    </div>

    <div class="dashboard-content">
        <!-- Welcome Banner sesuai foto -->
        <div class="welcome-card">
            <div>
                <div class="welcome-title">Selamat Datang, Admin!</div>
                <p style="opacity: 0.85; margin-top: 6px;">Ini ringkasan aktivitas perpustakaan hari ini.</p>
            </div>
            <div class="date-badge" id="liveDate">Wednesday, 08 April 2026</div>
        </div>

        <!-- Stats Cards sesuai foto -->
        <div class="stats-grid">
            <div class="stat-block">
                <div class="stat-header"><span>Total Anggota</span><i class="fas fa-users stat-icon"></i></div>
                <div class="stat-number">1</div>
                <div class="stat-trend trend-up"><i class="fas fa-arrow-up"></i> +12% dari bulan lalu</div>
            </div>
            <div class="stat-block">
                <div class="stat-header"><span>Total Buku</span><i class="fas fa-book stat-icon"></i></div>
                <div class="stat-number">5</div>
                <div class="stat-trend"><i class="fas fa-comment" style="color:#d4a373;"></i> <span id="bukuTersedia">202</span> Tersedia</div>
            </div>
            <div class="stat-block">
                <div class="stat-header"><span>Pending Peminjaman</span><i class="fas fa-clock stat-icon"></i></div>
                <div class="stat-number">0</div>
                <div class="stat-trend trend-up"><i class="fas fa-check-double"></i> Semua Clear</div>
            </div>
            <div class="stat-block">
                <div class="stat-header"><span>Sedang Dipinjam</span><i class="fas fa-book-reader stat-icon"></i></div>
                <div class="stat-number">2</div>
                <div class="stat-trend">Buku sedang dibaca</div>
            </div>
        </div>

        <!-- Quick Actions + Recent Activity -->
        <div class="double-section">
            <div class="quick-actions-card">
                <div class="card-title"><i class="fas fa-bolt" style="color:#d4a373;"></i> Quick Actions</div>
                <div class="action-buttons">
                    <div class="action-btn" id="tambahBukuBtn"><i class="fas fa-plus-circle"></i> Tambah Buku Baru</div>
                    <div class="action-btn" id="tambahKategoriBtn"><i class="fas fa-tag"></i> Tambah Kategori</div>
                    <div class="action-btn" id="kelolaPinjamBtn"><i class="fas fa-hand-holding"></i> Kelola Peminjaman</div>
                </div>
                <div id="toastMsg" class="toast-msg"></div>
            </div>

            <div class="recent-card">
                <div class="card-title"><i class="fas fa-history"></i> Aktivitas Terbaru</div>
                <ul class="activity-list" id="activityFeed">
                    <li class="activity-item"><div class="activity-icon"><i class="fas fa-book"></i></div><div><div class="activity-text">Buku "Pemrograman Web" ditambahkan</div><div class="activity-time">10 menit lalu</div></div></li>
                    <li class="activity-item"><div class="activity-icon"><i class="fas fa-user-plus"></i></div><div><div class="activity-text">Anggota baru: Andi Prasetyo</div><div class="activity-time">1 jam lalu</div></div></li>
                    <li class="activity-item"><div class="activity-icon"><i class="fas fa-undo-alt"></i></div><div><div class="activity-text">Pengembalian buku "Matematika Dasar"</div><div class="activity-time">2 jam lalu</div></div></li>
                </ul>
            </div>
        </div>

        <!-- Peminjaman Aktif -->
        <div class="transaction-card">
            <div class="card-title"><i class="fas fa-book-open"></i> Transaksi Peminjaman Aktif</div>
            <div id="loanPreview">
                <div style="display: flex; justify-content: space-between; padding: 12px 0; font-size:13px; color:#8b6b4f;">
                    <span><strong>Judul Buku</strong></span><span><strong>Anggota</strong></span><span><strong>Tgl Pinjam</strong></span><span><strong>Status</strong></span>
                </div>
                <div id="loanListContainer">
                    <div style="display: flex; justify-content: space-between; padding: 12px 0; border-top: 1px solid #f0e8df;">
                        <span>Pemrograman Python</span><span>Dewi Sartika</span><span>05/04/2026</span><span class="badge-pending">Dipinjam</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 12px 0; border-top: 1px solid #f0e8df;">
                        <span>Database System</span><span>Budi Raharjo</span><span>06/04/2026</span><span class="badge-pending">Dipinjam</span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="loan-status">
                <span><i class="fas fa-hourglass-half"></i> Total sedang dipinjam: <strong id="loanCountFooter">2</strong></span>
                <span class="lihat-link" id="lihatSemuaBtn"><i class="fas fa-arrow-right"></i> Kelola peminjaman →</span>
            </div>
        </div>
    </div>
</main>

<script>
    // Data sesuai foto
    let libraryStats = {
        totalAnggota: 1,
        totalBuku: 5,
        bukuTersedia: 202,
        pendingPeminjaman: 0,
        sedangDipinjam: 2
    };

    let activeLoans = [
        { book: "Pemrograman Python", member: "Dewi Sartika", date: "05/04/2026", status: "Dipinjam" },
        { book: "Database System", member: "Budi Raharjo", date: "06/04/2026", status: "Dipinjam" }
    ];

    let activities = [
        { text: "Buku \"Pemrograman Web\" ditambahkan", time: "10 menit lalu", icon: "fa-book" },
        { text: "Anggota baru: Andi Prasetyo", time: "1 jam lalu", icon: "fa-user-plus" },
        { text: "Pengembalian buku \"Matematika Dasar\"", time: "2 jam lalu", icon: "fa-undo-alt" }
    ];

    function updateStatsUI() {
        document.getElementById('bukuTersedia').innerText = libraryStats.bukuTersedia;
        document.getElementById('loanCountFooter').innerText = libraryStats.sedangDipinjam;
    }

    function renderLoans() {
        const container = document.getElementById('loanListContainer');
        if(activeLoans.length === 0) {
            container.innerHTML = '<div style="padding: 24px; text-align:center; color:#a88b6e;">Tidak ada peminjaman aktif</div>';
            libraryStats.sedangDipinjam = 0;
        } else {
            container.innerHTML = '';
            activeLoans.forEach(loan => {
                const row = document.createElement('div');
                row.style.display = 'flex';
                row.style.justifyContent = 'space-between';
                row.style.padding = '12px 0';
                row.style.borderTop = '1px solid #f0e8df';
                row.innerHTML = `
                    <span>${loan.book}</span>
                    <span>${loan.member}</span>
                    <span>${loan.date}</span>
                    <span class="badge-pending">${loan.status}</span>
                `;
                container.appendChild(row);
            });
            libraryStats.sedangDipinjam = activeLoans.length;
        }
        updateStatsUI();
    }

    function addActivity(text) {
        activities.unshift({ text: text, time: "Baru saja", icon: "fa-bell" });
        if(activities.length > 5) activities.pop();
        renderActivities();
        const toast = document.getElementById('toastMsg');
        toast.innerHTML = `✓ ${text}`;
        setTimeout(() => { if(toast) toast.innerHTML = ''; }, 2500);
    }

    function renderActivities() {
        const feed = document.getElementById('activityFeed');
        feed.innerHTML = '';
        activities.slice(0,5).forEach(act => {
            const li = document.createElement('li');
            li.className = 'activity-item';
            li.innerHTML = `
                <div class="activity-icon"><i class="fas ${act.icon || 'fa-book'}"></i></div>
                <div><div class="activity-text">${act.text}</div><div class="activity-time">${act.time}</div></div>
            `;
            feed.appendChild(li);
        });
    }

    function handleTambahBuku() {
        libraryStats.totalBuku += 1;
        libraryStats.bukuTersedia += 1;
        updateStatsUI();
        addActivity("Buku baru ditambahkan: 'React JS Modern'");
        // Update angka total buku di card
        const totalBukuElem = document.querySelector('.stats-grid .stat-block:nth-child(2) .stat-number');
        if(totalBukuElem) totalBukuElem.innerText = libraryStats.totalBuku;
    }

    function handleTambahKategori() {
        addActivity("Kategori baru ditambahkan: 'Teknologi & AI'");
    }

    function handleKelolaPeminjaman() {
        addActivity("Membuka halaman kelola peminjaman");
        alert("📚 Kelola Peminjaman\nSaat ini " + activeLoans.length + " buku sedang dipinjam.");
    }

    function updateDateDisplay() {
        const dateElem = document.getElementById('liveDate');
        const now = new Date();
        const englishDate = now.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        if(dateElem) dateElem.innerText = englishDate;
    }

    // Sidebar Toggle
    const sidebar = document.getElementById('sidebar');
    const mainPanel = document.getElementById('mainPanel');
    const toggleBtn = document.getElementById('toggleBtn');
    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        mainPanel.classList.toggle('expanded');
        if(window.innerWidth <= 768) sidebar.classList.toggle('mobile-open');
    });

    // Menu click
    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', () => {
            document.querySelectorAll('.menu-item').forEach(m => m.classList.remove('active'));
            item.classList.add('active');
            const menu = item.getAttribute('data-menu');
            addActivity(`Navigasi ke ${menu || 'menu'}`);
        });
    });

    // Action buttons
    document.getElementById('tambahBukuBtn')?.addEventListener('click', handleTambahBuku);
    document.getElementById('tambahKategoriBtn')?.addEventListener('click', handleTambahKategori);
    document.getElementById('kelolaPinjamBtn')?.addEventListener('click', handleKelolaPeminjaman);
    document.getElementById('lihatSemuaBtn')?.addEventListener('click', () => {
        addActivity("Membuka manajemen peminjaman");
        alert("📖 Halaman manajemen peminjaman dan pengembalian.");
    });

    // Inisialisasi
    function init() {
        updateStatsUI();
        renderLoans();
        renderActivities();
        updateDateDisplay();
        // Set total buku awal
        const totalBukuElem = document.querySelector('.stats-grid .stat-block:nth-child(2) .stat-number');
        if(totalBukuElem) totalBukuElem.innerText = "5";
    }
    init();

    window.addEventListener('resize', () => {
        if(window.innerWidth > 768) sidebar.classList.remove('mobile-open');
    });
</script>
</body>
</html>
