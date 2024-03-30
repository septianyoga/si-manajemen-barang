<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah_barang',
        'status',
        'total_harga',
        'tgl_pesan',
        'tgl_masuk',
        'bahan_baku_id',
        'supplier_id',
    ];

    public function bahan_baku(): BelongsTo
    {
        return $this->belongsTo(BahanBaku::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
