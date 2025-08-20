<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    use HasFactory;

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'nama',
        'deskripsi',
        'gambar',
        'tipe',
        'file_path',
        'link',
        'harga',
        'stock',
    ];
}
