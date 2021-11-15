<?php

namespace App\Http\Controllers\Profile;

use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileInformationRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileInformationController extends Controller
{
    private string $ui_avatar_api = "https://ui-avatars.com/api/?name=*+*&size=128";

    public function edit(): view
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
        $user->birthdate = $this->verifyDateFormat($validated['birthdate']);
        $user->phone_number = $validated['phone_number'];
        $user->home_phone_number = $validated['home_phone_number'];
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

    private function verifyDateFormat(?string $date): ?string
    {
        return isset($date)
            ? DateHelper::changeDateFormat($date, 'd/m/Y')
            : null;
    }
}
