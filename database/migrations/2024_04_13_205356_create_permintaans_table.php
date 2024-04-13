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
        Schema::create('permintaans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_dibutuhkan');
            $table->integer('total_barang');
            $table->bigInteger('total_harga');
            $table->enum('status_permintaan', ['Menunggu Approve', 'Dikonfirmasi', 'Selesai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaans');
    }
};
