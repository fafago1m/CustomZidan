<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
   public function transaksis()
{
    return $this->hasMany(Transaksi::class);
}
protected $fillable = [
    'nama',
    'deskripsi',
    'gambar',
    'tipe',
    'file_path',
    'link',
    'harga',
    'amount',
];

}
