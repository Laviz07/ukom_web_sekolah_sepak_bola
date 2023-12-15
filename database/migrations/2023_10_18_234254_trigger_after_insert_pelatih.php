<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $triggerName = 'trigger_after_insert_pelatih';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        DB::unprepared(
            "CREATE OR REPLACE TRIGGER $this->triggerName
            AFTER INSERT ON pelatih for each row

            BEGIN 
                DECLARE t_username varchar(50);
                DECLARE t_host varchar(50);
                DECLARE t_role ENUM('admin', 'pelatih', 'pemain');

                -- SELECT username into t_username from user where id_user = New.id_user;
                
                SELECT USER into t_username FROM information_schema.processlist where ID=connection_id();

                SELECT HOST into t_host FROM information_schema.processlist where ID=connection_id();

                
                -- SELECT password into t_password from user where id_user = New.id_user;
                SELECT role into t_role from user where id_user = New.id_user;
                
                SELECT foto_profil into @foto_profil from user where id_user = New.id_user;

                SET @deskripsi_pelatih := IFNULL(New.deskripsi_pelatih, '[NULL]');
                
                CALL Logger(t_username, t_host, 'INSERT',
                    CONCAT(
                        'id_user: ', New.id_user,
                        -- ',  password: ', t_password,
                        ', role: ', t_role,
                        ', nik_pelatih: ', New.nik_pelatih,
                        ', nama_pelatih: ', New.nama_pelatih,
                        ', no_telp: ', New.no_telp,
                        ', email: ', New.email,
                        ', tempat_lahir: ', New.tempat_lahir,
                        ', tanggal_lahir: ', New.tanggal_lahir,
                        ', alamat: ', New.alamat,
                        ', deskripsi_pelatih: ', @deskripsi_pelatih,
                        ', foto_profil: ', @foto_profil
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
        DB::unprepared("DROP TRIGGER IF EXISTS $this->triggerName");
    }
};
