<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            //
            $table->longText('keterangan')->nullable()->after('tgl_masuk');
        });
        DB::statement("ALTER TABLE pemesanans MODIFY COLUMN status ENUM('Menunggu Approve', 'Menunggu Konfirmasi', 'Dalam Proses', 'Selesai', 'Ditolak') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            //
            $table->dropColumn('keterangan');
        });
        DB::statement("ALTER TABLE pemesanans MODIFY COLUMN status ENUM('Menunggu Approve', 'Menunggu Konfirmasi', 'Dalam Proses', 'Selesai') NOT NULL");
    }
};
