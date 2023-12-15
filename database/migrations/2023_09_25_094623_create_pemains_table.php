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
        Schema::create('pemain', function (Blueprint $table) {
            $table->bigInteger("nisn_pemain")->primary();
            $table->integer("id_user")->nullable(false);
            // $table->integer("id_tim")->nullable(true);
            $table->string("id_tim", 7)->nullable(true);
            $table->string("nama_pemain", 50)->nullable(false);
            $table->date("tanggal_lahir")->default("2000-01-01")->nullable(false);
            $table->string("tempat_lahir", 255)->nullable(false);
            $table->string("email", 255)->nullable(false);
            $table->bigInteger("no_telp")->nullable(false);
            $table->string("alamat", 255)->nullable(false);
            $table->enum("posisi", ["kiper", "back", "gelandang", "striker"])->nullable(false);
            $table->enum("kategori_umur", ["7-12", "13-15", "16-18"])->nullable(false);
            $table->text("deskripsi_pemain")->nullable(true);
            $table->integer("no_punggung")->nullable(false);

            $table->foreign("id_user")->references("id_user")->on("user")
                ->onDelete("cascade")->onUpdate("cascade");

            $table->foreign("id_tim")->references("id_tim")->on("tim")
                ->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemain');
    }
};
