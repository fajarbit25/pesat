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
        Schema::create('egg_trans_temps', function (Blueprint $table) {
            $table->id();
            $table->string('trx_id')->nullable();
            $table->string('egg_id');
            $table->string('qty');
            $table->string('price');
            $table->string('total');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egg_trans_temps');
    }
};
