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
        Schema::create('t_klasemen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_club');
            $table->unsignedInteger('pertandingan_dimainkan')->default(0);
            $table->unsignedInteger('pertandingan_menang')->default(0);
            $table->unsignedInteger('pertandingan_seri')->default(0);
            $table->unsignedInteger('pertandingan_kalah')->default(0);
            $table->unsignedInteger('gol_memasukkan')->default(0);
            $table->unsignedInteger('gol_kebobolan')->default(0);
            $table->unsignedInteger('total_poin')->default(0);
            $table->timestamps();

            $table->foreign('id_club')->references('id')->on('t_club')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_klasemen');
    }
};
