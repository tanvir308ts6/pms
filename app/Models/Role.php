<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Accessors
     */
    public function getNameAttribute($value): string
    {
        return Str::ucfirst($value);
    }

    /**
     * Relationships
     *
     */
    /*A role can be assigned to one or more users   */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
