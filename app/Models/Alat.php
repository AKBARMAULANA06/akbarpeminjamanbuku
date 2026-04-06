<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alat';
    
    protected $fillable = [
        'kategori_id',
        'kode_alat',
        'nama_alat',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'deskripsi',
        'stok_total',
        'stok_tersedia',
        'harga_sewa_per_hari', 
        'kondisi',
        'foto',
    ];
    
    protected $casts = [
        'harga_sewa_per_hari' => 'integer',
        'stok_total' => 'integer',
        'stok_tersedia' => 'integer',
        'tahun_terbit' => 'integer',
    ];
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}