@extends('layouts.app')

@section('title', 'Manajemen Anggota')

@section('sidebar')
    @include('admin.components.sidebar')
@endsection

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
<div class="container-fluid px-4 py-4" style="background: #faf7f2; min-height: 100vh;">
    <!-- Header dengan desain buku -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <div class="d-flex align-items-center gap-3 mb-2">
                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-people-fill fs-3 text-white"></i>
                </div>
                <div>
                    <h2 class="fw-bold mb-1" style="color: #4a3b2c; font-family: 'Playfair Display', serif;">Manajemen Anggota</h2>
                    <p class="mb-0" style="color: #8b7a6b;">
                        <i class="bi bi-person-badge me-1"></i>Kelola data anggota perpustakaan
                    </p>
                </div>
            </div>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn d-flex align-items-center px-4 py-3" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 16px; font-weight: 600; border: none; box-shadow: 0 10px 20px -5px rgba(139, 90, 43, 0.3);">
            <i class="bi bi-plus-lg me-2"></i> Tambah Anggota
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0" style="border-radius: 32px; background: white; box-shadow: 0 20px 40px -15px rgba(100, 70, 40, 0.2); overflow: hidden;">
                <!-- Card Header -->
                <div class="card-header bg-transparent border-0 p-4" style="border-bottom: 2px solid #f0e7d8;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-journal-text" style="color: #8b5a2b;"></i>
                        <span class="fw-medium" style="color: #6b5c4d;">Daftar Anggota Perpustakaan</span>
                        <span class="ms-auto badge py-2 px-3" style="background: #f0e7d8; color: #8b5a2b;">
                            Total: {{ $users->total() }} Anggota
                        </span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0" style="border-collapse: separate; border-spacing: 0;">
                        <thead style="background: #f8f5f0;">
                            <tr>
                                <th class="ps-4 py-3" style="color: #6b5c4d; font-weight: 600; width: 5%;">No</th>
                                <th class="py-3" style="color: #6b5c4d; font-weight: 600;">Nama & Email</th>
                                <th class="py-3" style="color: #6b5c4d; font-weight: 600; width: 15%;">Role</th>
                                <th class="py-3" style="color: #6b5c4d; font-weight: 600; width: 15%;">Tanggal Registrasi</th>
                                <th class="text-end pe-4 py-3" style="color: #6b5c4d; font-weight: 600; width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $index => $user)
                                <tr style="border-bottom: 1px solid #f0e7d8;">
                                    <td class="ps-4 py-3">
                                        <span class="fw-bold" style="color: #8b7a6b;">{{ $users->firstItem() + $index }}</span>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center justify-content-center" 
                                                 style="width: 45px; height: 45px; 
                                                        background: {{ $user->role === 'admin' ? 'linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%)' : 
                                                                       ($user->role === 'petugas' ? 'linear-gradient(135deg, #2b5f4e 0%, #3b7b64 100%)' : 
                                                                       'linear-gradient(135deg, #4a3b2c 0%, #6b5c4d 100%)') }}; 
                                                        border-radius: 12px; color: white; font-weight: 600; font-size: 1.2rem;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold" style="color: #4a3b2c;">{{ $user->name }}</div>
                                                <div style="color: #8b7a6b; font-size: 0.85rem;">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        @if($user->role === 'admin')
                                            <span class="badge py-2 px-3" style="background: #f0e7d8; color: #8b5a2b; border-radius: 30px;">
                                                <i class="bi bi-shield-fill-check me-1"></i> Admin
                                            </span>
                                        @elseif($user->role === 'petugas')
                                            <span class="badge py-2 px-3" style="background: #d4edda; color: #155724; border-radius: 30px;">
                                                <i class="bi bi-person-badge me-1"></i> Petugas
                                            </span>
                                        @else
                                            <span class="badge py-2 px-3" style="background: #d1ecf1; color: #0c5460; border-radius: 30px;">
                                                <i class="bi bi-person me-1"></i> Anggota
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        <div style="color: #6b5c4d;">
                                            <i class="bi bi-calendar3 me-1" style="color: #8b5a2b;"></i>
                                            {{ $user->created_at->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="text-end pe-4 py-3">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.users.edit', $user) }}" 
                                               class="btn d-flex align-items-center justify-content-center" 
                                               style="background: #f0e7d8; color: #8b5a2b; border-radius: 12px; padding: 8px 16px; font-weight: 500;"
                                               title="Edit Anggota">
                                                <i class="bi bi-pencil me-1"></i> Edit
                                            </a>
                                            
                                            @if($user->id !== auth()->id())
                                                <button type="button" 
                                                        class="btn d-flex align-items-center justify-content-center delete-btn" 
                                                        data-user-id="{{ $user->id }}"
                                                        data-user-name="{{ $user->name }}"
                                                        style="background: #f0e7d8; color: #dc3545; border-radius: 12px; padding: 8px 16px; font-weight: 500;"
                                                        title="Hapus Anggota">
                                                    <i class="bi bi-trash me-1"></i> Hapus
                                                </button>
                                                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center py-4">
                                            <div style="font-size: 80px; opacity: 0.2; margin-bottom: 20px;">
                                                👤
                                            </div>
                                            <i class="bi bi-people" style="font-size: 3rem; color: #8b5a2b; opacity: 0.3; margin-bottom: 15px;"></i>
                                            <h5 class="fw-bold mb-2" style="color: #4a3b2c;">Belum Ada Anggota</h5>
                                            <p class="mb-3" style="color: #8b7a6b;">Mulai dengan menambah anggota perpustakaan pertama</p>
                                            <a href="{{ route('admin.users.create') }}" class="btn px-4 py-2" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); color: white; border-radius: 12px; font-weight: 500;">
                                                <i class="bi bi-plus-lg me-2"></i> Tambah Anggota
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($users->hasPages())
                    <div class="card-footer bg-transparent border-0 p-4" style="border-top: 2px solid #f0e7d8;">
                        <div class="d-flex justify-content-center">
                            <div class="pagination-wrapper" style="background: #f8f5f0; padding: 8px; border-radius: 50px;">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Card Footer -->
                <div class="card-footer bg-transparent border-0 p-4 text-end" style="border-top: 2px solid #f0e7d8;">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Total {{ $users->total() }} anggota terdaftar di perpustakaan
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Popup Konfirmasi Hapus -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 30px; overflow: hidden;">
            <div class="modal-header border-0" style="background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%); padding: 2rem 1.5rem 1.5rem;">
                <div class="text-center w-100">
                    <div class="mb-3">
                        <span style="font-size: 4rem;">📚</span>
                    </div>
                    <h5 class="modal-title fw-bold text-white" id="deleteConfirmModalLabel">Hapus Anggota</h5>
                </div>
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 mt-3 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4" style="background: #fffcf5;">
                <div class="mb-4">
                    <div style="font-size: 3rem; opacity: 0.2; margin-bottom: 10px;">
                        <i class="bi bi-exclamation-triangle-fill" style="color: #dc3545;"></i>
                    </div>
                    <p class="mb-2" style="color: #4a3b2c; font-size: 1.1rem;">
                        Apakah Anda yakin ingin menghapus anggota:
                    </p>
                    <p class="fw-bold mb-0" style="color: #8b5a2b; font-size: 1.3rem;" id="deleteUserName"></p>
                </div>
                
                <div class="alert" style="background: #f0e7d8; border-radius: 16px; padding: 1rem; margin-bottom: 1.5rem;">
                    <i class="bi bi-info-circle-fill me-2" style="color: #8b5a2b;"></i>
                    <span style="color: #6b5c4d;">Tindakan ini tidak dapat dibatalkan!</span>
                </div>

                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn px-4 py-2" data-bs-dismiss="modal" style="background: #f0e7d8; color: #6b5c4d; border-radius: 12px; font-weight: 500; min-width: 120px;">
                        <i class="bi bi-x-lg me-1"></i> Batal
                    </button>
                    <button type="button" class="btn px-4 py-2" id="confirmDeleteBtn" style="background: #dc3545; color: white; border-radius: 12px; font-weight: 500; min-width: 120px;">
                        <i class="bi bi-trash me-1"></i> Hapus
                    </button>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center" style="background: #fffcf5; padding: 1rem 1.5rem 2rem;">
                <small class="text-muted">
                    <i class="bi bi-journal-bookmark-fill me-1"></i>
                    Data yang dihapus akan hilang selamanya
                </small>
            </div>
        </div>
    </div>
</div>

<!-- CSS Tambahan -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap');

body {
    font-family: 'Inter', sans-serif;
    background: #faf7f2;
}

/* Styling untuk card */
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
    border-width: 0 40px 40px 0;
    border-color: transparent #f0e7d8 transparent transparent;
    opacity: 0.3;
    z-index: 10;
}

/* Styling untuk tabel */
.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background: #f8f5f0;
}

/* Styling untuk badge */
.badge {
    font-weight: 500;
    letter-spacing: 0.3px;
}

/* Styling untuk pagination */
.pagination {
    margin-bottom: 0;
    gap: 5px;
}

.page-link {
    border: none;
    padding: 8px 14px;
    color: #8b5a2b;
    background: transparent;
    border-radius: 30px !important;
    font-weight: 500;
    transition: all 0.2s ease;
}

.page-link:hover {
    background: #f0e7d8;
    color: #8b5a2b;
    transform: translateY(-2px);
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #8b5a2b 0%, #a8753a 100%);
    color: white;
    box-shadow: 0 5px 10px -3px rgba(139, 90, 43, 0.4);
}

/* Styling untuk tombol */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px -5px rgba(0,0,0,0.2);
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

/* Modal animation */
.modal.fade .modal-dialog {
    transform: scale(0.8);
    transition: transform 0.3s ease;
}

.modal.show .modal-dialog {
    transform: scale(1);
}

/* Responsive */
@media (max-width: 768px) {
    .card-body {
        padding: 1rem;
    }
    
    .btn {
        padding: 6px 12px !important;
        font-size: 0.85rem;
    }
    
    .d-flex.justify-content-end.gap-2 {
        flex-direction: column;
    }
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Inisialisasi modal
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
    let currentUserId = null;

    // Handle klik tombol delete
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const userId = this.dataset.userId;
            const userName = this.dataset.userName;
            
            currentUserId = userId;
            document.getElementById('deleteUserName').textContent = userName;
            
            deleteModal.show();
        });
    });

    // Handle konfirmasi delete
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (currentUserId) {
            document.getElementById(`delete-form-${currentUserId}`).submit();
        }
        deleteModal.hide();
    });

    // Optional: Close modal dengan tombol ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && deleteModal._isShown) {
            deleteModal.hide();
        }
    });
</script>
@endpush
@endsection