<?php

namespace App\Models;

use App\Traits\HasImage;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasImage;

    private string $ui_avatar_api = "https://ui-avatars.com/api/?name=*+*&size=128";

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'phone_number',
        'home_phone_number',
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
     * Accessors
     */
    public function getBirthdateAttribute($value): ?string
    {
        return isset($value) ? Carbon::parse($value)->format('d/m/Y') : null;
    }

    /**
     * Methods
     */
    public function getFullName(): string
    {
        return "$this->first_name $this->last_name";
    }

    public function hasRole(string $role): bool
    {
        return $this->role->name === $role;
    }

    public function generateAvatarUrl(): string
    {
        return Str::replaceArray(
            '*',
            [
                $this->first_name,
                $this->last_name
            ],
            $this->ui_avatar_api
        );
    }
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

    /*A user can only have one assigned jail*/
    public function jails(): BelongsToMany
    {
        return $this->belongsToMany(Jail::class)
            ->withTimestamps();
    }
}
