<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'profile_id',
        'password',
        'address',
        'active'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
        'profile_id' => 'integer',
        'active' => 'boolean',
        'is_admin' => 'boolean',
    ];

    protected $appends = ['is_admin', 'full_name'];


    public function fullName(): Attribute
    {
        return Attribute::make(
            get: function () {
                $first_name = Str::ucfirst($this->first_name);
                $last_name = Str::upper($this->last_name);

                return "{$last_name} {$first_name}";
            }

        );
    }

    public function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->profile_id === Profile::admin()->id
        );
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function userSession(): HasMany
    {
        return $this->hasMany(UserSession::class);
    }

    /// User::admin();
}