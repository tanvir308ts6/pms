<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Jail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'code', 'type', 'capacity', 'description'];


    /**
     * Relationships
     *
     */
    /*A jail can only have one assigned ward*/
    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    /*A jail can have one or more users*/
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps();
    }
}
