<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasImage
{
    /**
     * Relationships
     */
    /*A model can only have one image*/
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
