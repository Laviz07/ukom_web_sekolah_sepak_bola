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
        Schema::create('statistika', function (Blueprint $table) {
            $table->integer('id_statistika')->autoIncrement();
            $table->integer('id_peninjauan')->nullable(false);
            $table->string('detail_statistika', 50)->nullable(false);

            $table->foreign('id_peninjauan')->references('id_peninjauan')->on('peninjauan')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistika');
    }
};
