<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $fillable = ['code', 'amount', 'expires_at', 'is_active'];
    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
        'amount' => 'decimal:2',
    ];


    public function users()
    {
        return $this->belongsToMany(User::class, 'bonus_user')->withTimestamps();
    }

}


