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
    // Helper untuk menentukan route prefix berdasarkan role
    private function getRoutePrefix()
    {
        return auth()->user()->role === 'petugas' ? 'petugas' : 'admin';
    }
    
    // Helper untuk menentukan view folder berdasarkan role
    private function getViewPrefix()
    {
        return auth()->user()->role === 'petugas' ? 'petugas' : 'admin';
    }
    
    public function index()
    {
        $alats = Alat::with('kategori')->paginate(15);
        $viewPrefix = $this->getViewPrefix();
        return view("{$viewPrefix}.pages.alat.index", compact('alats'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $viewPrefix = $this->getViewPrefix();
        return view("{$viewPrefix}.pages.alat.create", compact('kategoris'));
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

            $routePrefix = $this->getRoutePrefix();
            return redirect()->route("{$routePrefix}.alat.index")
                ->with('success', 'Buku berhasil ditambahkan');

        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                if (strpos($e->getMessage(), 'kode_alat_unique') !== false) {
                    return back()
                        ->with('error', 'Kode buku sudah digunakan. Silakan gunakan kode lain.')
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
        $viewPrefix = $this->getViewPrefix();
        return view("{$viewPrefix}.pages.alat.show", compact('alat'));
    }

    public function edit(Alat $alat)
    {
        $kategoris = Kategori::all();
        $viewPrefix = $this->getViewPrefix();
        return view("{$viewPrefix}.pages.alat.edit", compact('alat', 'kategoris'));
    }

    public function update(Request $request, Alat $alat)
    {
        try {
            $isPetugas = auth()->user()->role === 'petugas';
            
            // Validasi dasar
            $rules = [
                'kategori_id' => 'required|exists:kategori,id',
                'nama_alat' => 'required|max:255',
                'penulis' => 'required|max:255',
                'penerbit' => 'required|max:255',
                'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
                'deskripsi' => 'nullable|string',
                'stok_total' => 'required|integer|min:0',
                'harga_sewa_per_hari' => 'required|integer|min:0',
                'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];
            
            // Admin bisa edit kode_alat, Petugas tidak
            if (!$isPetugas) {
                $rules['kode_alat'] = [
                    'required',
                    'max:50',
                    Rule::unique('alat', 'kode_alat')->ignore($alat->id)
                ];
                $rules['stok_tersedia'] = 'required|integer|min:0|lte:stok_total';
            }
            
            $validated = $request->validate($rules);
            
            // Validasi tambahan untuk petugas
            if ($isPetugas) {
                // Petugas tidak bisa mengubah stok_tersedia
                $validated['stok_tersedia'] = $alat->stok_tersedia;
                
                // Cek stok tidak boleh kurang dari stok tersedia
                if ($request->stok_total < $alat->stok_tersedia) {
                    return back()
                        ->with('error', 'Stok total tidak boleh kurang dari stok yang tersedia saat ini (' . $alat->stok_tersedia . ')')
                        ->withInput();
                }
            }

            if ($request->hasFile('foto')) {
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
            
            LogService::log('update_alat', "Mengupdate alat: {$alat->nama_alat} ({$alat->kode_alat})");

            $routePrefix = $this->getRoutePrefix();
            return redirect()->route("{$routePrefix}.alat.index")
                ->with('success', 'Buku berhasil diupdate');
                
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Alat $alat)
    {
        // Petugas tidak boleh menghapus
        if (auth()->user()->role === 'petugas') {
            return back()->with('error', 'Petugas tidak memiliki izin untuk menghapus buku!');
        }
        
        try {
            if ($alat->foto) {
                Storage::disk('public')->delete($alat->foto);
            }
    
            $nama = $alat->nama_alat;
            $kode = $alat->kode_alat;
            $alat->delete();
            
            LogService::log('delete_alat', "Menghapus alat: {$nama} ({$kode})");
    
            return redirect()->route('admin.alat.index')
                ->with('success', 'Buku berhasil dihapus');
                
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return back()->with('error', 'Gagal menghapus! Buku ini sedang digunakan dalam transaksi peminjaman.');
            }
            return back()->with('error', 'Terjadi kesalahan database: ' . $e->getMessage());
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan tak terduga: ' . $e->getMessage());
        }
    }
}