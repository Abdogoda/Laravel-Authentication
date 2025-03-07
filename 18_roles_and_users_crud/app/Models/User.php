<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable{

    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'otp',
        'account_verified_at',
        'logout_other_devices',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array{
        return [
            'account_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sessions(): HasMany{
        return $this->hasMany(Session::class);
    }
    
    public function roles(): BelongsToMany{
        return $this->belongsToMany(Role::class);
    }
}