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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_barang');
            $table->enum('status', ['Menunggu Approve', 'Menunggu Konfirmasi', 'Dalam Proses', 'Selesai']);
            $table->bigInteger('total_harga');
            $table->unsignedBigInteger('bahan_baku_id')->nullable();
            $table->foreign('bahan_baku_id')->references('id')->on('bahan_bakus')->onDelete('set null');
            $table->date('tgl_pesan');
            $table->date('tgl_masuk')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
