<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'proof',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The requests that belong to the user.
     */
    public function requests(): BelongsToMany
    {
        return $this->belongsToMany(Request::class);
    }

    /**
     * The items that belong to the user.
     */
    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isDonor(): bool
    {
        return $this->hasRole('donor');
    }

    public function isDonee(): bool
    {
        return $this->hasRole('donee');
    }

    public function isVerified ()
    {
        if ($this->email_verified_at) {
            return true;
        }

        return false;
    }

}
