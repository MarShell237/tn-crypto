<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'method',
        'status',
        'reference',
        'phone',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
        'amount' => 'decimal:2',
    ];

    // Relation vers User
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // Constantes utiles
    public const METHODS = ['MOMO', 'OM', 'CRYPTO'];
}
