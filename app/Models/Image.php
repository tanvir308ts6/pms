<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['path'];

    /**
     * Relationships
     *
     */
    /*It's a polymorphic relationship*/
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
