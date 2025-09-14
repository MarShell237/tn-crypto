<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LuckyWin extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'user_name', 'reward'];
}

