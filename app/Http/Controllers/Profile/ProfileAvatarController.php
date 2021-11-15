<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\ImageRequest;
use Illuminate\Http\RedirectResponse;

class ProfileAvatarController extends Controller
{
    public function update(ImageRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = $request->user();
        $user->updateImage($validated['image'], 'avatars');

        return back()->with('status', 'Avatar update successfully');
    }
}
