<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use App\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AlatController extends Controller
{
    public function index()
    {
        $alats = Alat::with('kategori')->paginate(15);
        return view('admin.pages.alat.index', compact('alats'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.pages.alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kategori_id' => 'required|exists:kategori,id',
                'kode_alat' => 'required|unique:alat,kode_alat|max:50',
                'nama_alat' => 'required|max:255',
                'penulis' => 'required|max:255',
                'penerbit' => 'required|max:255',
                'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
                'deskripsi' => 'nullable|string',
                'stok_total' => 'required|integer|min:0',
                'harga_sewa_per_hari' => 'required|integer|min:0',
                'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Set stok_tersedia = stok_total untuk buku baru
            $validated['stok_tersedia'] = $validated['stok_total'];

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9.]/', '_', $file->getClientOriginalName());
                
                $path = $file->storeAs('alat', $fileName, 'public');
                
                if (!$path) {
                    return back()->with('error', 'Gagal mengupload foto.')->withInput();
                }
                
                $validated['foto'] = 'alat/' . $fileName;
            }

            $alat = Alat::create($validated);
            
            LogService::log('create_alat', "Menambahkan alat: {$alat->nama_alat} ({$alat->kode_alat}) dengan denda Rp " . number_format($alat->harga_sewa_per_hari, 0, ',', '.'));

            return redirect()->route('admin.alat.index')
                ->with('success', 'Alat berhasil ditambahkan');

        } catch (\Illuminate\Database\QueryException $e) {
            // Tangani error database
            if ($e->getCode() == 23000) {
                // Cek apakah error karena unique constraint tahun_terbit
                if (strpos($e->getMessage(), 'tahun_terbit_unique') !== false) {
                    return back()
                        ->with('error', 'Terjadi kesalahan: Constraint unique pada tahun terbit masih ada di database. Silakan hapus dengan menjalankan SQL: ALTER TABLE alat DROP INDEX alat_tahun_terbit_unique;')
                        ->withInput();
                }
                
                // Error duplicate kode_alat
                if (strpos($e->getMessage(), 'kode_alat_unique') !== false) {
                    return back()
                        ->with('error', 'Kode alat sudah digunakan. Silakan gunakan kode lain.')
                        ->withInput();
                }
            }
            
            return back()
                ->with('error', 'Terjadi kesalahan database: ' . $e->getMessage())
                ->withInput();
                
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Alat $alat)
    {
        return view('admin.pages.alat.show', compact('alat'));
    }

    public function edit(Alat $alat)
    {
        $kategoris = Kategori::all();
        return view('admin.pages.alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, Alat $alat)
    {
        try {
            $validated = $request->validate([
                'kategori_id' => 'required|exists:kategori,id',
                'kode_alat' => [
                    'required',
                    'max:50',
                    Rule::unique('alat', 'kode_alat')->ignore($alat->id)
                ],
                'nama_alat' => 'required|max:255',
                'penulis' => 'required|max:255',
                'penerbit' => 'required|max:255',
                'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
                'deskripsi' => 'nullable|string',
                'stok_total' => 'required|integer|min:0',
                'stok_tersedia' => 'required|integer|min:0|lte:stok_total',
                'harga_sewa_per_hari' => 'required|integer|min:0',
                'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('foto')) {
                // Delete old files
                if ($alat->foto) {
                    Storage::disk('public')->delete($alat->foto);
                }
                
                $file = $request->file('foto');
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9.]/', '_', $file->getClientOriginalName());
                
                $path = $file->storeAs('alat', $fileName, 'public');
                
                if (!$path) {
                    return back()->with('error', 'Gagal mengupload foto.')->withInput();
                }
                
                $validated['foto'] = 'alat/' . $fileName;
            }

            $alat->update($validated);
            
            LogService::log('update_alat', "Mengupdate alat: {$alat->nama_alat} ({$alat->kode_alat}) dengan denda Rp " . number_format($alat->harga_sewa_per_hari, 0, ',', '.'));

            return redirect()->route('admin.alat.index')
                ->with('success', 'Alat berhasil diupdate');
                
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Alat $alat)
    {
        try {
            if ($alat->foto) {
                Storage::disk('public')->delete($alat->foto);
            }
    
            $nama = $alat->nama_alat;
            $kode = $alat->kode_alat;
            $alat->delete();
            
            LogService::log('delete_alat', "Menghapus alat: {$nama} ({$kode})");
    
            return redirect()->route('admin.alat.index')
                ->with('success', 'Alat berhasil dihapus');
                
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return back()->with('error', 'Gagal menghapus! Alat ini sedang digunakan dalam transaksi peminjaman.');
            }
            return back()->with('error', 'Terjadi kesalahan database: ' . $e->getMessage());
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan tak terduga: ' . $e->getMessage());
        }
    }
}