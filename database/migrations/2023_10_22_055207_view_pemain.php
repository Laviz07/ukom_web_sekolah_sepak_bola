<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        DB::unprepared(
            "CREATE OR REPLACE VIEW v_pemain AS
            SELECT 
                pemain.id_user, 
                pemain.id_tim, 
                pemain.nisn_pemain, 
                pemain.nama_pemain, 
                pemain.tanggal_lahir, 
                pemain.tempat_lahir, 
                pemain.email, 
                pemain.no_telp, 
                pemain.alamat, 
                pemain.posisi, 
                pemain.kategori_umur, 
                pemain.deskripsi_pemain, 
                pemain.no_punggung
            FROM pemain

            INNER JOIN user ON user.id_user = pemain.id_user
            INNER JOIN tim ON tim.id_tim = pemain.id_tim
            "
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
