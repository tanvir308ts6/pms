<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasImage
{
    public function updateUIAvatar(string $avatar_url): void
    {
        $user_image = $this->image;
        $image_path = $user_image->path;
        if (Str::startsWith($image_path, 'https://')) {
            $user_image->path = $avatar_url;
            $user_image->save();
        }
    }

    public function storeImage(UploadedFile $new_image, string $directory = 'images'): void
    {
        $image = new Image([
            'path' => $new_image->store($directory),
        ]);

        $this->image()->save($image);
    }

    public function updateImage(UploadedFile $new_image, string $directory = 'images'): void
    {
        $previous_image = $this->image;

        if ($previous_image) {
            $previous_image_path = $previous_image->path;

            $previous_image->path = $new_image->store($directory);
            $previous_image->save();

            Storage::delete($previous_image_path);
        } else {
            $this->storeImage($new_image, $directory);
        }
    }


    /**
     * Relationships
     */
    /*A model can only have one image*/
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
