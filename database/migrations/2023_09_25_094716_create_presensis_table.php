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
        Schema::create('presensi', function (Blueprint $table) {
            $table->integer('id_presensi')->autoIncrement();
            // $table->integer('id_kegiatan')->nullable(false);
            $table->string('id_kegiatan', 7)->nullable(false);
            $table->date('hari_tanggal_hadir')->default('1960-01-01')->nullable(false);

            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('kegiatan')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};
