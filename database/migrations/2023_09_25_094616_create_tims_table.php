<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tim', function (Blueprint $table) {
            $table->string("id_tim", 7)->primary();
            // $table->integer("id_tim")->autoIncrement();
            $table->bigInteger("nik_pelatih")->nullable(false);
            $table->string("nama_tim", 50)->nullable(false);
            $table->text("deskripsi_tim")->nullable(true);
            $table->string("foto_tim", 255)->nullable(true);
            $table->timestamp('created_at')->nullable(false)->useCurrent();

            $table->foreign("nik_pelatih")->on("pelatih")->references("nik_pelatih")
                ->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tim');
    }
};
