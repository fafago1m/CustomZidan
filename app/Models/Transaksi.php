<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
   public function produk()
{
    return $this->belongsTo(Produk::class);
}



protected $fillable = [
    'nama',
    'email',
    'no_wa',
    'produk_id',
    'status',
    'kode_unik',
    'amount', // <--- ini penting!
];


}
