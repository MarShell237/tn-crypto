<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class withdrawals extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'method',
        'status',
        'phone',
        'meta',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
