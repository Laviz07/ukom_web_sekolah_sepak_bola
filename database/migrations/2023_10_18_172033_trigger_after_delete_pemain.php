<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $triggerName = 'trigger_after_delete_pemain';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        DB::unprepared(
            "CREATE TRIGGER $this->triggerName
            AFTER DELETE ON pemain FOR each ROW

            BEGIN

                DECLARE t_username VARCHAR(50);
                DECLARE t_host varchar(50);
                DECLARE t_role ENUM('admin', 'pelatih', 'pemain');

                -- SELECT username into t_username from user where id_user = old.id_user;
                SELECT USER into t_username FROM information_schema.processlist where ID=connection_id();

                SELECT HOST into t_host FROM information_schema.processlist where ID=connection_id();

                SELECT role into t_role from user where id_user = old.id_user;

                SELECT foto_profil into @foto_profil from user where id_user = old.id_user;

                SET @deskripsi_pemain := ifnull(old.deskripsi_pemain, '[NULL]');

                CALL Logger(t_username, t_host, 'DELETE',
                    CONCAT(
                        'id_user: ', Old.id_user,
                        ', role: ', t_role,
                        ', nisn_pemain: ', Old.nisn_pemain,
                        ', nama_pemain: ', Old.nama_pemain,
                        ', no_telp: ', Old.no_telp,
                        ', email: ', Old.email,
                        ', tempat_lahir: ', Old.tempat_lahir,
                        ', tanggal_lahir: ', Old.tanggal_lahir,
                        ', alamat: ', Old.alamat,
                        ', no_punggung: ', Old.no_punggung,
                        ', posisi: ', Old.posisi,
                        ', kategori_umur: ', Old.kategori_umur,
                        ', deskripsi_pemain: ', @deskripsi_pemain,
                        ', foto_profil: ', @foto_profil
                    )
                );
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
