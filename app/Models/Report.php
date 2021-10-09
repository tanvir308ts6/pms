<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Report extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description'];


    /**
     * Relationships
     *
     */
    /*A report belongs to one user*/
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*A report can only have one image*/
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
