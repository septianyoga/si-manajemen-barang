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
        Schema::create('permintaan_barangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permintaan_id')->nullable();
            $table->foreign('permintaan_id')->references('id')->on('permintaans')->onDelete('set null');
            $table->unsignedBigInteger('barang_id')->nullable();
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('set null');
            $table->bigInteger('harga');
            $table->integer('jumlah_barang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_barangs');
    }
};
