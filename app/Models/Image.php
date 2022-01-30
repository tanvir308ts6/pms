<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path'];

    /**
     * Accessors
     */
    public function getUrl(): string
    {
        return Str::startsWith($this->path, 'https://')
            ? $this->path
            : Storage::disk('dropbox')->url($this->path);
    }

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
