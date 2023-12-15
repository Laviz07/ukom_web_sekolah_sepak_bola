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
        Schema::create('berita', function (Blueprint $table) {
            $table->string('id_berita', 7)->primary();
            $table->bigInteger('nik_admin')->nullable(false);
            $table->string('judul_berita', 255)->nullable(false);
            $table->string('foto_berita', 255)->nullable(true);
            $table->text('isi_berita')->nullable(true);
            $table->timestamp('created_at')->nullable(false)->useCurrent();

            $table->foreign('nik_admin')->references('nik_admin')->on('admin')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
