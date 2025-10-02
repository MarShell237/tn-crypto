<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserProduit extends Pivot
{
    protected $table = 'user_produit';

    protected $fillable = [
        'user_id',
        'produit_id',
        'duree',
        'revenu',
        'prix',
    ];

    protected $casts = [
        'duree'  => 'integer',
        'revenu' => 'decimal:2',
        'prix'   => 'decimal:2',
    ];

    // Si tu veux inclure les timestamps
    public $timestamps = true;

    // Relations facultatives
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
