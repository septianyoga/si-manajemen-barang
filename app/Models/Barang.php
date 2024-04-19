<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'harga_barang',
        'stok_barang',
        'status_barang',
        'kategori_id',
    ];

    public function barang_bahan_baku(): HasMany
    {
        return $this->hasMany(BarangBahanBaku::class);
    }

    public function permintaan_barang(): HasMany
    {
        return $this->hasMany(PermintaanBarang::class);
    }
}
