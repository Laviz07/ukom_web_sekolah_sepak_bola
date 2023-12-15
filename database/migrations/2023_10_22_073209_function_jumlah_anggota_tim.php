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
            "CREATE OR REPLACE FUNCTION HitungJumlahAnggotaTim(id_tim INT) RETURNS INT
            BEGIN
                DECLARE jumlah INT;

                -- Menghitung jumlah anggota tim
                SELECT COUNT(*) INTO jumlah FROM pemain WHERE id_tim = id_tim;

                -- Mengembalikan jumlah anggota tim
                RETURN jumlah;
            END;"

            //untuk mejalankan di cli:
            //select id_tim, nama_tim, HitungJumlahAnggotaTim(id_tim) as 'jumlahAnggota' from tim;

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
