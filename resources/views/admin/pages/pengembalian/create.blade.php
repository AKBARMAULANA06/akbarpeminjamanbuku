@extends('layouts.app')

@section('title', 'Proses Pengembalian Buku')

@section('sidebar')
    @if(auth()->user()->role === 'petugas')
        @include('petugas.components.sidebar')
    @else
        @include('admin.components.sidebar')
    @endif
@endsection

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('page-title', 'Proses Pengembalian Buku')

@php
    $routePrefix = auth()->user()->role === 'petugas' ? 'petugas' : 'admin';
@endphp

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Header dengan desain buku -->
            <div class="d-flex align-items-center gap-3 mb-4">
                <a href="{{ route($routePrefix . '.peminjaman.index') }}" 
                   class="btn rounded-circle shadow-sm d-flex align-items-center justify-content-center" 
                   style="width: 45px; height: 45px; background: white; color: #8b5a2b; border: 1px solid #e0d5c5;">
                    <i class="bi bi-arrow-left fs-5"></i>
                </a>
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <h3 class="fw-bold mb-0" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">Proses Pengembalian Buku</h3>
                        <i class="bi bi-journal-arrow-up" style="color: #8b5a2b;"></i>
                    </div>
                    <p class="mb-0" style="color: #8b7a6b;">
                        <i class="bi bi-info-circle me-1"></i>Formulir pengembalian buku untuk transaksi #{{ $peminjaman->id }}
                    </p>
                </div>
            </div>

            <!-- Form Utama -->
            <div class="card border-0" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2); overflow: hidden;">
                <!-- Card Header -->
                <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-journal-text" style="color: #8b5a2b;"></i>
                        <span class="fw-medium" style="color: #6b5c4d;">Formulir Pengembalian Buku</span>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route($routePrefix . '.pengembalian.store', $peminjaman) }}" method="POST">
                        @csrf
                        
                        <!-- Tanggal Kembali Aktual -->
                        <div class="mb-4">
                            <label for="tanggal_kembali_aktual" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                <i class="bi bi-calendar-check me-1" style="color: #8b5a2b;"></i>Tanggal Kembali Aktual *
                            </label>
                            <div class="position-relative">
                                <input type="date" class="form-control @error('tanggal_kembali_aktual') is-invalid @enderror" 
                                       id="tanggal_kembali_aktual" name="tanggal_kembali_aktual" 
                                       value="{{ old('tanggal_kembali_aktual', date('Y-m-d')) }}" 
                                       max="{{ date('Y-m-d') }}" required
                                       style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9; font-size: 1rem;">
                                <div class="position-absolute end-0 top-50 translate-middle-y pe-3" style="pointer-events: none;">
                                    <i class="bi bi-calendar3" style="color: #8b5a2b; opacity: 0.3;"></i>
                                </div>
                            </div>
                            @error('tanggal_kembali_aktual')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                            <small class="text-muted mt-2 d-block">
                                <i class="bi bi-info-circle me-1" style="color: #8b5a2b;"></i>
                                Tanggal seharusnya kembali: <strong style="color: #8b5a2b;">{{ $peminjaman->tanggal_kembali_rencana->format('d/m/Y') }}</strong>
                            </small>
                        </div>
                        
                        <!-- Kondisi Buku -->
                        <div class="mb-4">
                            <label for="kondisi_alat" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                <i class="bi bi-clipboard-check me-1" style="color: #8b5a2b;"></i>Kondisi Buku Saat Dikembalikan *
                            </label>
                            <select class="form-select @error('kondisi_alat') is-invalid @enderror" 
                                    id="kondisi_alat" name="kondisi_alat" required
                                    style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9; font-size: 1rem;">
                                <option value="">-- Pilih Kondisi Buku --</option>
                                <option value="baik" {{ old('kondisi_alat') == 'baik' ? 'selected' : '' }}>Baik (Layak Baca)</option>
                                <option value="rusak_ringan" {{ old('kondisi_alat') == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan (Sobek kecil, coretan)</option>
                                <option value="rusak_berat" {{ old('kondisi_alat') == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat (Halaman hilang, rusak parah)</option>
                            </select>
                            @error('kondisi_alat')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Keterangan -->
                        <div class="mb-4">
                            <label for="keterangan" class="form-label fw-medium mb-2" style="color: #4a3b2c;">
                                <i class="bi bi-chat-left-text me-1" style="color: #8b5a2b;"></i>Keterangan Tambahan
                            </label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                      id="keterangan" name="keterangan" rows="4" 
                                      placeholder="Catatan kondisi buku, keterlambatan, atau informasi lainnya..."
                                      style="padding: 14px 18px; border-radius: 16px; border: 1.5px solid #e0d5c5; background: #fefcf9;">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Info Denda -->
                        <div class="alert mb-4 p-4" style="background: #f0e7d8; border-left: 4px solid #8b5a2b; border-radius: 16px;">
                            <div class="d-flex align-items-start gap-3">
                                <i class="bi bi-exclamation-triangle-fill fs-4" style="color: #8b5a2b;"></i>
                                <div>
                                    <h6 class="fw-bold mb-2" style="color: #4a3b2c;">Informasi Denda Keterlambatan:</h6>
                                    <ul class="mb-0 ps-3" style="color: #6b5c4d;">
                                        <li>Denda keterlambatan: <strong style="color: #8b5a2b;">Rp 5.000 per hari</strong></li>
                                        <li>Denda akan dihitung otomatis berdasarkan tanggal kembali aktual</li>
                                        <li>Tidak ada denda jika dikembalikan tepat waktu atau lebih awal</li>
                                        <li>Kerusakan buku akan dikenakan biaya perbaikan sesuai ketentuan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Divider -->
                        <div class="d-flex align-items-center gap-3 my-4">
                            <div style="flex: 1; height: 2px; background: linear-gradient(to right, transparent, #8b5a2b, transparent);"></div>
                            <i class="bi bi-arrow-return-left" style="color: #8b5a2b;"></i>
                            <div style="flex: 1; height: 2px; background: linear-gradient(to right, transparent, #8b5a2b, transparent);"></div>
                        </div>
                        
                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-3 justify-content-end">
                            <a href="{{ route($routePrefix . '.peminjaman.index') }}" class="btn px-5 py-3" style="background: #f0e7d8; color: #8b5a2b; border-radius: 16px; font-weight: 600;">
                                <i class="bi bi-x-lg me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn px-5 py-3" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 16px; font-weight: 600; border: none; box-shadow: 0 10px 20px -5px rgba(139, 90, 43, 0.3);">
                                <i class="bi bi-check-lg me-2"></i>Proses Pengembalian
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Sidebar Informasi -->
        <div class="col-md-4">
            <!-- Info Peminjaman Card -->
            <div class="card border-0 mb-4" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1); overflow: hidden;">
                <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
                    <h5 class="mb-0 fw-bold" style="color: #4a3b2c;">
                        <i class="bi bi-info-circle me-2" style="color: #8b5a2b;"></i>Info Peminjaman
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-journal-bookmark-fill text-white"></i>
                        </div>
                        <div>
                            <div class="small text-muted">ID Transaksi</div>
                            <div class="fw-bold fs-5" style="color: #4a3b2c;">#{{ $peminjaman->id }}</div>
                        </div>
                    </div>
                    
                    <table class="table table-borderless" style="font-size: 0.9rem;">
                        <tr>
                            <td style="color: #8b7a6b; width: 40%;">Peminjam</td>
                            <td class="fw-bold" style="color: #4a3b2c;">{{ $peminjaman->user->name }}</td>
                        </tr>
                        <tr>
                            <td style="color: #8b7a6b;">Judul Buku</td>
                            <td class="fw-bold" style="color: #4a3b2c;">{{ $peminjaman->alat->nama_alat }}</td>
                        </tr>
                        <tr>
                            <td style="color: #8b7a6b;">ISBN</td>
                            <td class="fw-bold" style="color: #4a3b2c;">{{ $peminjaman->alat->kode_alat }}</td>
                        </tr>
                        <tr>
                            <td style="color: #8b7a6b;">Jumlah</td>
                            <td class="fw-bold" style="color: #4a3b2c;">{{ $peminjaman->jumlah }} Eksemplar</td>
                        </tr>
                        <tr>
                            <td style="color: #8b7a6b;">Tgl Pinjam</td>
                            <td class="fw-bold" style="color: #4a3b2c;">{{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td style="color: #8b7a6b;">Tgl Rencana</td>
                            <td class="fw-bold" style="color: #4a3b2c;">{{ $peminjaman->tanggal_kembali_rencana->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td style="color: #8b7a6b;">Status</td>
                            <td>
                                @if($peminjaman->status == 'approved')
                                    <span class="badge py-2 px-3" style="background: #d4edda; color: #155724; border-radius: 30px;">
                                        <i class="bi bi-book me-1"></i> Sedang Dipinjam
                                    </span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <!-- Perhitungan Denda Card -->
            <div class="card border-0" style="border-radius: 24px; background: white; box-shadow: 0 10px 30px -10px rgba(100, 70, 40, 0.1); overflow: hidden;">
                <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
                    <h5 class="mb-0 fw-bold" style="color: #4a3b2c;">
                        <i class="bi bi-calculator me-2" style="color: #8b5a2b;"></i>Perhitungan Denda
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span style="color: #6b5c4d;">Tanggal Rencana:</span>
                            <span class="fw-bold" style="color: #4a3b2c;">{{ $peminjaman->tanggal_kembali_rencana->format('d/m/Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span style="color: #6b5c4d;">Tanggal Aktual:</span>
                            <span class="fw-bold" style="color: #4a3b2c;" id="tanggalAktualDisplay">{{ date('d/m/Y') }}</span>
                        </div>
                    </div>
                    
                    @php
                        $today = \Carbon\Carbon::today();
                        $rencana = $peminjaman->tanggal_kembali_rencana;
                        $daysLate = $today->gt($rencana) ? $today->diffInDays($rencana) : 0;
                        $estimatedDenda = $daysLate * 5000;
                    @endphp
                    
                    <div class="p-4 rounded-3 mb-3" style="background: #f8f5f0;" id="dendaContainer">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span style="color: #6b5c4d;">Keterlambatan:</span>
                            <span class="fw-bold" style="color: #8b5a2b;" id="daysLate">{{ $daysLate }} Hari</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span style="color: #6b5c4d;">Denda:</span>
                            <span class="fw-bold fs-5" style="color: #8b5a2b;" id="dendaAmount">Rp {{ number_format($estimatedDenda, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <div class="alert p-3 mb-0" style="background: {{ $daysLate > 0 ? '#f8d7da' : '#d4edda' }}; color: {{ $daysLate > 0 ? '#721c24' : '#155724' }}; border-radius: 12px;">
                        <i class="bi {{ $daysLate > 0 ? 'bi-exclamation-triangle-fill' : 'bi-check-circle-fill' }} me-2"></i>
                        @if($daysLate > 0)
                            <strong>Terlambat {{ $daysLate }} hari</strong> - Denda Rp {{ number_format($estimatedDenda, 0, ',', '.') }}
                        @else
                            <strong>Tepat Waktu</strong> - Tidak ada denda keterlambatan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk Update Denda Otomatis -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tanggalInput = document.getElementById('tanggal_kembali_aktual');
    const tanggalDisplay = document.getElementById('tanggalAktualDisplay');
    const daysLateSpan = document.getElementById('daysLate');
    const dendaAmountSpan = document.getElementById('dendaAmount');
    const dendaContainer = document.getElementById('dendaContainer');
    
    // Format tanggal ke display
    function formatDate(dateString) {
        const date = new Date(dateString);
        const day = date.getDate().toString().padStart(2, '0');
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }
    
    // Hitung denda
    function hitungDenda(tanggalAktual) {
        const tglRencana = new Date('{{ $peminjaman->tanggal_kembali_rencana->format("Y-m-d") }}');
        const tglAktual = new Date(tanggalAktual);
        
        // Reset time to compare dates only
        tglRencana.setHours(0, 0, 0, 0);
        tglAktual.setHours(0, 0, 0, 0);
        
        const diffTime = tglAktual - tglRencana;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        const daysLate = diffDays > 0 ? diffDays : 0;
        const denda = daysLate * 5000;
        
        return { daysLate, denda };
    }
    
    // Update tampilan
    function updateDisplay() {
        const tanggal = tanggalInput.value;
        if (tanggal) {
            tanggalDisplay.textContent = formatDate(tanggal);
            
            const { daysLate, denda } = hitungDenda(tanggal);
            
            daysLateSpan.textContent = daysLate + ' Hari';
            dendaAmountSpan.textContent = 'Rp ' + denda.toLocaleString('id-ID');
            
            // Update warna background
            if (daysLate > 0) {
                dendaContainer.style.background = '#f8d7da';
                dendaContainer.style.color = '#721c24';
            } else {
                dendaContainer.style.background = '#d4edda';
                dendaContainer.style.color = '#155724';
            }
        }
    }
    
    tanggalInput.addEventListener('change', updateDisplay);
    updateDisplay(); // Initial update
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
    border-width: 0 30px 30px 0;
    border-color: transparent #f0e7d8 transparent transparent;
    opacity: 0.3;
    z-index: 10;
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
        width: 100%;
    }
    
    .d-flex.gap-3 {
        flex-direction: column;
    }
}
</style>
@endsection