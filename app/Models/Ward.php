<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'description'];


    /**
     * Relationships
     *
     */
    /*A ward can have assigned users (guards)*/
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->wherePivot('state', true)
            ->withTimestamps();
    }

    /*A ward can have one or more jails*/
    public function jails(): HasMany
    {
        return $this->hasMany(Jail::class);
    }
}
