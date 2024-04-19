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
        Schema::table('bahan_bakus', function (Blueprint $table) {
            //
            $table->decimal('lead_time')->after('kategori')->nullable();
            $table->decimal('safety_stock')->after('lead_time')->nullable();
            $table->decimal('rop')->after('safety_stock')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bahan_bakus', function (Blueprint $table) {
            //
            $table->dropColumn('lead_time');
            $table->dropColumn('safety_stock');
            $table->dropColumn('rop');
        });
    }
};
