<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Win extends Model
{
    protected $fillable = ['user_id', 'reward', 'amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
