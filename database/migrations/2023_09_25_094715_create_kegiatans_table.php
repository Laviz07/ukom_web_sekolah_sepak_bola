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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->integer('id_kegiatan')->autoIncrement();
            $table->integer('id_jadwal')->nullable(false);
            $table->text('nama_kegiatan')->nullable(false);
            $table->string('nama_pelatih', 50)->nullable(false);
            $table->enum('tipe_kegiatan', ['latihan', 'pertandingan'])->nullable(false);
            $table->time('jam_mulai')->nullable(false);
            $table->time('jam_selesai')->nullable(false);
            $table->string('foto_kegiatan', 255)->nullable(true);
            $table->text('detail_kegiatan')->nullable(false);
            $table->string('laporan_kegiatan', 255)->nullable(false);

            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal')
                ->onDelete('cascade')->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
