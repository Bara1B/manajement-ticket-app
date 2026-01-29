<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('lokasis', function (Blueprint $table) {
        $table->unsignedBigInteger('id')->primary()->autoIncrement();
        $table->string('nama_lokasi', 255);
        $table->char('aktif', 1)->default('Y');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('lokasi');
    }
};