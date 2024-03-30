<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    // public function kategori(): BelongsTo
    // {
    //     return $this->belongsTo(Kategori::class);
    // }
}
