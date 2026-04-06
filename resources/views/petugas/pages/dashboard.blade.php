@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Petugas</h1>
    
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $stats['total_users'] }}</h5>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Alat</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $stats['total_alat'] }}</h5>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Total Kategori</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $stats['total_kategori'] }}</h5>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Peminjaman Pending</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $stats['peminjaman_pending'] }}</h5>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">Peminjaman Approved</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $stats['peminjaman_approved'] }}</h5>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">Peminjaman Returned</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $stats['peminjaman_returned'] }}</h5>
                </div>
            </div>
        </div>
    </div>
    
    <h2 class="mt-4">Peminjaman Terbaru</h2>
    
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Alat</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recent_peminjaman as $peminjaman)
            <tr>
                <td>{{ $peminjaman->id }}</td>
                <td>{{ $peminjaman->user->name ?? 'N/A' }}</td>
                <td>{{ $peminjaman->alat->nama_alat ?? 'N/A' }}</td>
                <td>{{ $peminjaman->tanggal_pinjam ?? 'N/A' }}</td>
                <td>{{ $peminjaman->tanggal_kembali ?? 'N/A' }}</td>
                <td>
                    @if($peminjaman->status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif($peminjaman->status == 'approved')
                        <span class="badge bg-success">Approved</span>
                    @elseif($peminjaman->status == 'returned')
                        <span class="badge bg-info">Returned</span>
                    @else
                        <span class="badge bg-secondary">{{ $peminjaman->status }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection