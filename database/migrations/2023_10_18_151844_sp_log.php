<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $sp = 'Logger';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        DB::unprepared(
            "DROP PROCEDURE IF EXISTS $this->sp;
             
            CREATE OR REPLACE PROCEDURE $this->sp
            (
                Username Varchar(50),
                Host Varchar(50),
                Action ENUM('INSERT', 'UPDATE', 'DELETE'),
                Log TEXT
            )
            MODIFIES SQL DATA

            BEGIN
                INSERT INTO logs (username, host, action, log)
                VALUES (Username, Host, Action, Log);
            END;
            "
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared("DROP PROCEDURE IF EXISTS $this->sp");
    }
};
