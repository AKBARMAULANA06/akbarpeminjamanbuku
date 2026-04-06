@extends('layouts.app')

@section('title', 'Pinjam Buku')

@section('sidebar')
    @include('user.components.sidebar')
@endsection

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <!-- Header dengan desain buku -->
    <div class="d-flex align-items-center gap-3 mb-4">
        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-journal-plus fs-3 text-white"></i>
        </div>
        <div>
            <h2 class="fw-bold mb-1" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">Formulir Peminjaman Buku</h2>
            <p class="mb-0" style="color: #8b7a6b;">
                <i class="bi bi-info-circle me-1"></i>Isi detail di bawah untuk meminjam buku
            </p>
        </div>
    </div>

    <!-- Info tanggal hari ini -->
    <div class="alert d-flex align-items-center mb-4 p-3" style="background: #f0e7d8; border-radius: 12px;">
        <i class="bi bi-calendar3 me-3 fs-5" style="color: #8b5a2b;"></i>
        <div>
            <span class="fw-medium">{{ now()->format('l, d F Y') }}</span>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2); overflow: hidden;">
                <!-- Card Header -->
                <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-journal-text" style="color: #8b5a2b;"></i>
                        <span class="fw-medium" style="color: #6b5c4d;">Form Peminjaman Buku</span>
                    </div>
                </div>

                <div class="card-body p-5 pt-0">
                    <form action="{{ route('user.peminjaman.store') }}" method="POST" id="peminjamanForm">
                        @csrf
                        
                        <!-- STEP 1: PILIH BUKU -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <div style="width: 40px; height: 40px; background: #8b5a2b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">1</div>
                                <h5 class="fw-bold mb-0" style="color: #4a3b2c;">
                                    <i class="bi bi-book me-2" style="color: #8b5a2b;"></i>PILIH BUKU
                                </h5>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                    <i class="bi bi-search me-1" style="color: #8b5a2b;"></i>Cari Buku
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0" style="border-color: #e0d5c5;">
                                        <i class="bi bi-search" style="color: #8b5a2b;"></i>
                                    </span>
                                    <select class="form-select border-start-0" id="alat_id" name="alat_id" required 
                                            style="border-radius: 0 16px 16px 0; border: 1.5px solid #e0d5c5; padding: 14px 16px; background: #fefcf9;">
                                        <option value="">Pilih buku yang tersedia...</option>
                                        @foreach($alats as $buku)
                                            @php
                                                $fotoPath = $buku->foto ? 'storage/' . $buku->foto : null;
                                                $fullPath = $fotoPath ? public_path($fotoPath) : null;
                                                $imgUrl = ($fotoPath && file_exists($fullPath)) ? asset($fotoPath) : asset('img/premium.webp');
                                            @endphp
                                            <option value="{{ $buku->id }}" 
                                                    {{ old('alat_id') == $buku->id ? 'selected' : '' }}
                                                    data-stok="{{ $buku->stok_tersedia }}"
                                                    data-harga="{{ $buku->harga_sewa_per_hari }}"
                                                    data-nama="{{ $buku->nama_alat }}"
                                                    data-penulis="{{ $buku->penulis ?? 'Penulis tidak diketahui' }}"
                                                    data-img="{{ $imgUrl }}">
                                                {{ $buku->nama_alat }} - {{ $buku->penulis ?? 'Penulis tidak diketahui' }} (Rp {{ number_format($buku->harga_sewa_per_hari, 0) }}/hari)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Info buku terpilih -->
                            <div class="mt-3 p-3 rounded-3 border" id="selectedBookInfo" style="border-color: #e0d5c5 !important; display: none; background: #f8f5f0;">
                                <div class="d-flex align-items-center">
                                    <div style="width: 40px; height: 40px; background: #f0e7d8; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                        <i class="bi bi-journal-bookmark-fill" style="color: #8b5a2b;"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold" style="color: #4a3b2c;" id="selectedBookTitle"></div>
                                        <div class="small text-muted" id="selectedBookAuthor"></div>
                                    </div>
                                    <span class="badge py-2 px-3" style="background: #8b5a2b; color: white;" id="selectedBookStock"></span>
                                </div>
                            </div>
                        </div>

                        <!-- STEP 2: TENTUKAN DURASI -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <div style="width: 40px; height: 40px; background: #8b5a2b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">2</div>
                                <h5 class="fw-bold mb-0" style="color: #4a3b2c;">
                                    <i class="bi bi-calendar-week me-2" style="color: #8b5a2b;"></i>TENTUKAN DURASI
                                </h5>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="small text-muted mb-1">
                                        <i class="bi bi-calendar-plus me-1" style="color: #8b5a2b;"></i>Tanggal Pinjam
                                    </label>
                                    <div class="position-relative">
                                        <input type="date" class="form-control" 
                                               id="tanggal_pinjam" name="tanggal_pinjam" 
                                               value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" 
                                               min="{{ date('Y-m-d') }}" required
                                               style="padding: 14px 16px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                                        <i class="bi bi-calendar3 position-absolute end-0 top-50 translate-middle-y me-3" style="color: #8b5a2b; pointer-events: none;"></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="small text-muted mb-1">
                                        <i class="bi bi-calendar-x me-1" style="color: #8b5a2b;"></i>Rencana Kembali
                                    </label>
                                    <div class="position-relative">
                                        <input type="date" class="form-control" 
                                               id="tanggal_kembali_rencana" name="tanggal_kembali_rencana" 
                                               value="{{ old('tanggal_kembali_rencana', date('Y-m-d', strtotime('+7 days'))) }}" 
                                               min="{{ date('Y-m-d', strtotime('+1 day')) }}" required
                                               style="padding: 14px 16px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                                        <i class="bi bi-calendar3 position-absolute end-0 top-50 translate-middle-y me-3" style="color: #8b5a2b; pointer-events: none;"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-3" id="durationBadge" style="display: none;">
                                <span class="badge py-2 px-3" style="background: #f0e7d8; color: #8b5a2b; border-radius: 30px;">
                                    <i class="bi bi-clock-history me-2"></i>Durasi: <span id="durasiText">0 Hari</span>
                                </span>
                            </div>
                            
                            <div class="mt-2 small text-muted">
                                <i class="bi bi-info-circle me-1" style="color: #8b5a2b;"></i>Maksimal durasi peminjaman 14 hari
                            </div>
                        </div>

                        <!-- STEP 3: INFORMASI TAMBAHAN -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <div style="width: 40px; height: 40px; background: #8b5a2b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">3</div>
                                <h5 class="fw-bold mb-0" style="color: #4a3b2c;">
                                    <i class="bi bi-chat-left-text me-2" style="color: #8b5a2b;"></i>INFORMASI TAMBAHAN
                                </h5>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="small text-muted mb-1">
                                        <i class="bi bi-layers me-1" style="color: #8b5a2b;"></i>Jumlah Eksemplar
                                    </label>
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="1" min="1" required
                                           style="padding: 14px 16px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                                    <small class="text-muted" id="stokHelp"></small>
                                </div>
                                <div class="col-md-8">
                                    <label class="small text-muted mb-1">
                                        <i class="bi bi-pencil me-1" style="color: #8b5a2b;"></i>Keperluan (Opsional)
                                    </label>
                                    <input type="text" class="form-control" name="keperluan" placeholder="Contoh: Tugas sekolah, bacaan santai, penelitian" 
                                           style="padding: 14px 16px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">
                                </div>
                            </div>
                        </div>

                        <!-- Rincian Biaya / Denda -->
                        <div class="card border-0 mb-4" id="priceCalculator" style="display: none; background: #f8f5f0; border-radius: 20px;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <i class="bi bi-calculator fs-5" style="color: #8b5a2b;"></i>
                                    <h5 class="mb-0 fw-bold" style="color: #4a3b2c;">Rincian Denda</h5>
                                    <span class="ms-auto badge py-2 px-3" style="background: #8b5a2b; color: white;" id="calc_nama_badge">-</span>
                                </div>
                                
                                <div class="d-flex justify-content-between mb-2" style="color: #6b5c4d;">
                                    <span><i class="bi bi-cash me-1"></i>Denda per hari</span>
                                    <span id="calc_harga_per_hari">Rp 0 x 0 hari x 0 buku</span>
                                </div>
                                
                                <hr style="border-color: #e0d5c5;">
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold" style="color: #4a3b2c;">Total Denda</span>
                                    <span class="fs-3 fw-bold" style="color: #8b5a2b;" id="calc_total">Rp 0</span>
                                </div>
                                
                                <div class="mt-2 small text-muted">
                                    <i class="bi bi-info-circle me-1"></i>Denda dikenakan jika terlambat mengembalikan buku
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn py-3" 
                                    style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 50px; font-weight: 600; border: none; font-size: 1.1rem;">
                                <i class="bi bi-bookmark-check me-2"></i> Ajukan Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('peminjamanForm');
    const bukuSelect = document.getElementById('alat_id');
    const tanggalPinjam = document.getElementById('tanggal_pinjam');
    const tanggalKembali = document.getElementById('tanggal_kembali_rencana');
    const jumlahInput = document.getElementById('jumlah');
    const priceCalculator = document.getElementById('priceCalculator');
    const durationBadge = document.getElementById('durationBadge');
    const submitBtn = document.querySelector('button[type="submit"]');
    const selectedBookInfo = document.getElementById('selectedBookInfo');
    const selectedBookTitle = document.getElementById('selectedBookTitle');
    const selectedBookAuthor = document.getElementById('selectedBookAuthor');
    const selectedBookStock = document.getElementById('selectedBookStock');

    // Helper: Format Rupiah
    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
    }

    function updateSelectedBook() {
        const selectedOption = bukuSelect.options[bukuSelect.selectedIndex];
        
        if (!selectedOption.value) {
            selectedBookInfo.style.display = 'none';
            return;
        }

        const nama = selectedOption.dataset.nama || '-';
        const penulis = selectedOption.dataset.penulis || 'Penulis tidak diketahui';
        const stok = selectedOption.dataset.stok || 0;

        selectedBookTitle.textContent = nama;
        selectedBookAuthor.innerHTML = `<i class="bi bi-pencil me-1"></i>${penulis}`;
        selectedBookStock.textContent = `Stok: ${stok}`;
        selectedBookInfo.style.display = 'block';
    }

    function calculatePrice() {
        const selectedOption = bukuSelect.options[bukuSelect.selectedIndex];
        
        if (!selectedOption.value || !tanggalPinjam.value || !tanggalKembali.value) {
            priceCalculator.style.display = 'none';
            durationBadge.style.display = 'none';
            return;
        }

        const hargaPerHari = parseFloat(selectedOption.dataset.harga) || 0;
        const namaBuku = selectedOption.dataset.nama || '-';
        const stok = parseInt(selectedOption.dataset.stok) || 0;
        const jumlah = parseInt(jumlahInput.value) || 1;

        // Validasi stok
        if (jumlah > stok) {
            jumlahInput.value = stok;
        }

        const date1 = new Date(tanggalPinjam.value);
        const date2 = new Date(tanggalKembali.value);

        if (date2 <= date1) {
            priceCalculator.style.display = 'none';
            durationBadge.style.display = 'none';
            return;
        }

        const diffTime = Math.abs(date2 - date1);
        const diffDays = Math.max(1, Math.ceil(diffTime / (1000 * 60 * 60 * 24)));
        
        // Maksimal 14 hari
        if (diffDays > 14) {
            const newDate = new Date(date1.getTime() + (14 * 24 * 60 * 60 * 1000));
            tanggalKembali.value = newDate.toISOString().split('T')[0];
            return calculatePrice();
        }

        const totalDenda = hargaPerHari * diffDays * jumlah;

        // Update UI
        document.getElementById('calc_nama_badge').textContent = namaBuku;
        document.getElementById('calc_harga_per_hari').textContent = `${formatRupiah(hargaPerHari)} x ${diffDays} hari x ${jumlah} buku`;
        document.getElementById('calc_total').textContent = formatRupiah(totalDenda);
        document.getElementById('durasiText').textContent = `${diffDays} Hari`;
        
        priceCalculator.style.display = 'block';
        durationBadge.style.display = 'inline-block';
    }

    // Event Listeners
    bukuSelect.addEventListener('change', function() {
        updateSelectedBook();
        
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            const stok = parseInt(selectedOption.dataset.stok) || 0;
            jumlahInput.max = stok;
            
            let helpText = document.getElementById('stokHelp');
            helpText.innerHTML = `<i class="bi bi-info-circle me-1"></i>Stok tersedia: ${stok} eksemplar`;
        }
        calculatePrice();
    });

    tanggalPinjam.addEventListener('change', calculatePrice);
    tanggalKembali.addEventListener('change', calculatePrice);
    jumlahInput.addEventListener('input', calculatePrice);

    // Form Submit
    form.addEventListener('submit', function(e) {
        const selectedOption = bukuSelect.options[bukuSelect.selectedIndex];
        const stok = parseInt(selectedOption.dataset.stok) || 0;
        const jumlah = parseInt(jumlahInput.value) || 1;

        if (jumlah > stok) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Stok Tidak Mencukupi',
                text: 'Jumlah buku melebihi stok tersedia!',
                confirmButtonColor: '#8b5a2b'
            });
            return;
        }

        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Memproses...';
        setTimeout(() => {
            submitBtn.classList.add('disabled');
            submitBtn.style.pointerEvents = 'none';
        }, 100);
    });
});
</script>
@endsection