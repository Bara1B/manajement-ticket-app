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
        Schema::table('tikets', function (Blueprint $table) {
            $table->foreignId('tipe_tiket_id')
                ->nullable()
                ->after('event_id')
                ->constrained('tipe_tikets')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tikets', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\TipeTiket::class, 'tipe_tiket_id');
        });
    }
};
