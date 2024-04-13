<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PermintaanBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'permintaan_id',
        'barang_id',
        'harga',
        'jumlah_barang'
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }
}
