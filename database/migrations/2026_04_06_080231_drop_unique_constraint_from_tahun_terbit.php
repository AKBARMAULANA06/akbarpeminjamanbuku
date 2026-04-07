<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('alat', function (Blueprint $table) {
            // Hapus unique constraint pada kolom tahun_terbit
            $table->dropUnique('alat_tahun_terbit_unique');
            
            // Atau jika nama indexnya berbeda, coba cara ini:
            // $table->dropIndex('alat_tahun_terbit_unique');
        });
    }

    public function down()
    {
        Schema::table('alat', function (Blueprint $table) {
            // Kembalikan unique constraint (jika rollback)
            $table->unique('tahun_terbit', 'alat_tahun_terbit_unique');
        });
    }
};