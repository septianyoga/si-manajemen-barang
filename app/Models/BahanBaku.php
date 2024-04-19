<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BahanBaku extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'satuan',
        'harga',
        'biaya_penyimpanan',
        'stok',
        'kategori',
        'lead_time',
        'safety_stock',
        'rop'
    ];

    public function pemesanan(): HasMany
    {

        return $this->hasMany(Pemesanan::class)->whereYear('tgl_pesan', date('Y') - 1);
    }

    public function barang_bahan_baku(): HasMany
    {
        return $this->hasMany(BarangBahanBaku::class);
    }
}
