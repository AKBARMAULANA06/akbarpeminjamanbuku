<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('alat', function (Blueprint $table) {
            // Cek apakah kolom sudah ada sebelum menambahkan
            if (!Schema::hasColumn('alat', 'tahun_terbit')) {
                $table->string('tahun_terbit', 50)->nullable(); // HAPUS unique()
            }
            
            if (!Schema::hasColumn('alat', 'penulis')) {
                $table->string('penulis', 255)->nullable(); // Sesuaikan dengan form
            }
            
            if (!Schema::hasColumn('alat', 'penerbit')) {
                $table->string('penerbit', 255)->nullable(); // Sesuaikan dengan form
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alat', function (Blueprint $table) {
            $columns = ['tahun_terbit', 'penulis', 'penerbit'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('alat', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};