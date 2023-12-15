<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('presensi-detail', function (Blueprint $table) {
            $table->integer('id_presensi_detail')->autoIncrement();
            $table->integer('id_presensi')->nullable(false);
            $table->bigInteger('nisn_pemain')->nullable(false);
            $table->bigInteger('nik_pelatih')->nullable(false);
            $table->enum('keterangan', ['hadir', 'sakit', 'izin'])->nullable(false);

            $table->foreign('id_presensi')->references('id_presensi')->on('presensi')
                ->onDelete('cascade')->onUpdate("cascade");

            $table->foreign('nisn_pemain')->references('nisn_pemain')->on('pemain')
                ->onDelete('cascade')->onUpdate("cascade");

            $table->foreign('nik_pelatih')->references('nik_pelatih')->on('pelatih')
                ->onDelete('cascade')->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi-detail');
    }
};
