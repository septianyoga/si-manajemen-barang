<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangBahanBaku extends Model
{
    use HasFactory;
    protected $table = 'barang_bahan_baku';
    protected $fillable = [
        'barang_id',
        'bahan_baku_id',
        'jumlah'
    ];

    public function bahan_baku(): BelongsTo
    {
        return $this->belongsTo(BahanBaku::class);
    }
}
