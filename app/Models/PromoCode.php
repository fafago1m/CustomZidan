<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'usage_limit',
        'times_used',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
