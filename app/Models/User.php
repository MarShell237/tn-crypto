<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'country',
        'balance',
        'referral_code', // nouveau
        'referred_by',   // nouveau
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Génération automatique du referral_code lors de la création
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->referral_code)) {
                $user->referral_code = self::generateReferralCode();
            }
            // Ajouter un solde initial
            $user->balance = 1000; // 1000 FCFA
            });
    }

    /**
     * Génère un code de parrainage unique
     */
    public static function generateReferralCode($length = 8)
    {
        do {
            $code = strtoupper(Str::random($length));
        } while (self::where('referral_code', $code)->exists());

        return $code;
    }

    /**
     * Relations pour le parrainage
     */
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function wins()
    {
        return $this->hasMany(Win::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'user_produit')
                    ->withPivot(['duree', 'revenu', 'prix'])
                    ->withTimestamps();
    }


    // public function produits()
    // {
    //     return $this->belongsToMany(Produit::class, 'user_produit')
    //                 ->withPivot('duree', 'revenu', 'prix')
    //                 ->withTimestamps();
    // }

    }
