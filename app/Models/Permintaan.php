<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Permintaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_dibutuhkan',
        'total_barang',
        'total_harga',
        'status_permintaan'
    ];

    public function permintaan_barang(): HasMany
    {
        return $this->hasMany(PermintaanBarang::class);
    }
}
