<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileInformationRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileInformationController extends Controller
{
    private string $ui_avatar_api = "https://ui-avatars.com/api/?name=*+*&size=128";

    public function create(): view
    {
        return view('profile.show', [
            'user' => Auth::user(),
        ]);
    }

    public function update(UpdateProfileInformationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = $request->user();

        /*Update the model using Eloquent*/
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->username = $validated['username'];
        $user->birthdate = Carbon::createFromFormat('d/m/Y', $validated['birthdate'])->format('Y-m-d');
        $user->personal_phone = $validated['personal_phone'];
        $user->home_phone = $validated['home_phone'];
        $user->address = $validated['address'];
        $user->save();

        $this->updateUIAvatar($user);

        return back()->with('status', 'Profile update successfully');
    }

    private function updateUIAvatar(User $user): void
    {
        $user_image = $user->image;
        $image_path = $user_image->path;
        if (Str::startsWith($image_path, 'https://')) {
            $user_image->path = Str::replaceArray(
                '*',
                [
                    $user->first_name,
                    $user->last_name
                ],
                $this->ui_avatar_api
            );
            $user_image->save();
        }
    }
}
