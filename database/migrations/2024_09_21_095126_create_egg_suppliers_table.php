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
        Schema::create('egg_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Nama supplier
            $table->string('contact');  // Informasi kontak supplier
            $table->string('address');  // Alamat supplier
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egg_suppliers');
    }
};
