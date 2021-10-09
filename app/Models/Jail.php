<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
