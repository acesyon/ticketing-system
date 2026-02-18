<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    // Tell Laravel the primary key is 'userID'
    protected $primaryKey = 'userID';

    // If your userID is not auto-incrementing (optional)
    // public $incrementing = true; // default is true

    // If your primary key is not an integer (optional)
    // protected $keyType = 'int'; // default is 'int'

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'email',
        'contact_no',
        'password',
    ];

    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getNameAttribute(): string
    {
        return collect([$this->first_name, $this->middle_name, $this->last_name])
            ->filter()
            ->implode(' ');
    }

    public function initials(): string
    {
        return Str::of($this->first_name)->substr(0, 1)->append(
            Str::of($this->last_name)->substr(0, 1)
        )->upper()->toString();
    }
}
