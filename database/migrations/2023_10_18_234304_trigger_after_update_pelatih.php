<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $triggerName = 'trigger_after_update_pelatih';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        DB::unprepared(
            " CREATE TRIGGER $this->triggerName
            AFTER UPDATE ON pelatih FOR each ROW

            BEGIN
                DECLARE t_username varchar(50);
                DECLARE t_host varchar(50);

                -- SELECT username into t_username from user where id_user = New.id_user;

                SELECT USER into t_username FROM information_schema.processlist where ID=connection_id();

                SELECT HOST into t_host FROM information_schema.processlist where ID=connection_id();

                SET @deskripsi_pelatih := IFNULL(New.deskripsi_pelatih, '[NULL]');

                CALL Logger(t_username, t_host, 'UPDATE',
                    CONCAT(
                        'from: ', '{',
                        'nama_pelatih: ', Old.nama_pelatih,
                        ', alamat: ', Old.alamat,
                        ', no_telp: ', Old.no_telp,
                        ', email: ', Old.email,
                        ', deskripsi_pelatih: ', Old.deskripsi_pelatih,
                        '}',
                        'to: ', '{',
                        'nama_pelatih: ', New.nama_pelatih,
                        ', alamat: ', New.alamat,
                        ', no_telp: ', New.no_telp,
                        ', email: ', New.email,
                        ', deskripsi_pelatih: ', @deskripsi_pelatih,
                        '}'
                    ));
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
