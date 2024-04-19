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
        Schema::create('keuangans', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->enum('kategori', ['Pemasukan', 'Pengeluaran']);
            $table->bigInteger('biaya');
            $table->unsignedBigInteger('pemesanan_id')->nullable();
            $table->foreign('pemesanan_id')->references('id')->on('pemesanans')->onDelete('set null');
            $table->unsignedBigInteger('permintaan_id')->nullable();
            $table->foreign('permintaan_id')->references('id')->on('permintaans')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangans');
    }
};
