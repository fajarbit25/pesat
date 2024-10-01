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
        Schema::create('egg_mutasis', function (Blueprint $table) {
            $table->id();
            $table->string('egg_id');  // Relasi ke tabel eggs
            $table->string('supplier_id');
            $table->integer('qty');  // Jumlah mutasi
            $table->integer('stockawal');  // Jumlah SAwal
            $table->integer('atockakhir');  // Jumlah SAkhir
            $table->date('date');  // Tanggal mutasi
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egg_mutasis');
    }
};
