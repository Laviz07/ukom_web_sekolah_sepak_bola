<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private $sfName = 'function_id_kegiatan';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        DB::unprepared(
            " CREATE OR REPLACE FUNCTION $this->sfName() RETURNS VARCHAR(7) 
            BEGIN
                DECLARE custom_id VARCHAR(7);
                DECLARE max_id INT;

                -- Ambil ID terbesar dari tabel
                SELECT MAX(CAST(SUBSTRING(id_kegiatan, 4) AS SIGNED)) INTO max_id FROM kegiatan;

                -- check jika tabel kosong, maka angka selanjutnya 1
                IF max_id IS NULL THEN
                    SET max_id = 1;
                ELSE
                    SET max_id = max_id + 1;
                END IF;

                -- Buat custom ID
                SET custom_id = CONCAT('KGT', LPAD(max_id, 4, '0'));

                RETURN custom_id;

            END"
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
