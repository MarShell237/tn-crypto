<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'nom',
        'prix',
        'duree',
        'revenu',
        'emoji',
    ];

    protected $casts = [
        'prix'   => 'decimal:2',
        'revenu' => 'decimal:2',
        'duree'  => 'integer',
    ];

    // Ajout automatique dans JSON
    protected $appends = ['revenu_journalier'];

    /**
     * Accessor pour revenu_journalier
     */
    public function getRevenuJournalierAttribute()
    {
        $duree = (int) $this->duree;
        $revenu = (float) $this->revenu;

        if ($duree <= 0 || $revenu == 0.0) {
            return 0.00;
        }

        return round($revenu / $duree, 2);
    }
}
