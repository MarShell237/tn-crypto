<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
        protected $fillable = [
            'user_id',
            'nom',
            'prix_achat',
            'duree_jours',
            'revenu_total',
        ];

        // Relation avec User
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
