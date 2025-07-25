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
        Schema::table('transaksi_masuks', function (Blueprint $table) {
            $table->foreignId('barang_id')->constrained()->onDelete('cascade');
            $table->integer('jumlah');
            $table->date('tanggal_masuk');
        });
    }

    public function down(): void
    {
        Schema::table('transaksi_masuks', function (Blueprint $table) {
            $table->dropForeign(['barang_id']);
            $table->dropColumn(['barang_id', 'jumlah', 'tanggal_masuk']);
        });
    }
};
