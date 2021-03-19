<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'provider_id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function championships(): HasMany
    {
        return $this->hasMany(Championship::class, 'user_id');
    }

    /**
     * @return HasManyThrough
     */
    public function seasons(): HasManyThrough
    {
        return $this->hasManyThrough(Season::class, Championship::class);
    }

    /**
     * @return HasMany
     */
    public function championshipRequests(): HasMany
    {
        return $this->hasMany(ChampionshipRequest::class, 'user_id');
    }
}
