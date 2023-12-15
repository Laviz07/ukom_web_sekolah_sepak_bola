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
        Schema::create('peninjauan', function (Blueprint $table) {
            $table->integer('id_peninjauan')->autoIncrement();
            $table->bigInteger('nisn_pemain')->nullable(false);
            // $table->integer('id_kegiatan')->nullable(false);
            $table->string('id_kegiatan', 7)->nullable(false);
            $table->date('tanggal_peninjauan')->default('1960-01-01')->nullable(false);
            $table->text('evaluasi')->nullable(false);
            $table->integer('nilai')->nullable(false);

            $table->foreign('nisn_pemain')->references('nisn_pemain')->on('pemain')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('kegiatan')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peninjauan');
    }
};
