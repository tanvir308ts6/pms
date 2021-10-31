<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'personal_phone',
        'home_phone',
        'address',
        'password',
        'email',
        'birthdate',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationships
     *
     */
    /*A user can only have one role*/
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /*A user (guard) can be assigned to one or more wards*/
    public function wards(): BelongsToMany
    {
        return $this->belongsToMany(Ward::class)
            ->withTimestamps();
    }

    /*A user (guard) can have one or more reports*/
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    /*A user can only have one image*/
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /*A user can only have one assigned jail*/
    public function jails(): BelongsToMany
    {
        return $this->belongsToMany(Jail::class)
            ->withTimestamps();
    }
}
