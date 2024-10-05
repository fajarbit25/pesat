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
        Schema::create('egg_trxes', function (Blueprint $table) {
            $table->id();
            $table->string('idtransaksi');
            $table->string('user_id');
            $table->string('costumer_id');
            $table->enum('tipetrx', ['egg', 'medic', 'pakan']);
            $table->enum('payment_status', ['pending', 'lunas'])->default('lunas');
            $table->enum('trxtipe', ['penjualan', 'pembelian']);
            $table->integer('totalprice');
            $table->integer('disc');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egg_trxes');
    }
};
