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

    private $triggerName = 'trigger_after_update_admin';

    public function up(): void
    {
        //
        DB::unprepared(
            " CREATE TRIGGER $this->triggerName
            AFTER UPDATE ON admin FOR each ROW

            BEGIN
                DECLARE t_username varchar(50);
                DECLARE t_host varchar(50);

                -- SELECT username into t_username from user where id_user = New.id_user;

                SELECT USER into t_username FROM information_schema.processlist where ID=connection_id();

                SELECT HOST into t_host FROM information_schema.processlist where ID=connection_id();

                CALL Logger(t_username, t_host, 'UPDATE',
                    CONCAT(
                        'from: ', '{',
                        'nama_admin: ', Old.nama_admin,
                        ', no_telp: ', Old.no_telp,
                        ', email: ', Old.email,
                        '}',
                        'to: ', '{',
                        'nama_admin: ', New.nama_admin,
                        ', no_telp: ', New.no_telp,
                        ', email: ', New.email,
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
