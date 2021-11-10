<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileInformationRequest;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileInformationController extends Controller
{
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

        /*Update the model using the save() method*/
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->username = $validated['username'];
        $user->birthdate = Carbon::createFromFormat('d/m/Y', $validated['birthdate'])->format('Y-m-d');
        $user->personal_phone = $validated['personal_phone'];
        $user->home_phone = $validated['home_phone'];
        $user->address = $validated['address'];
        $user->save();

        /*Before saving in the DB, a casting of the date of birth string is performed*/
        /*$validated['birthdate'] = Carbon::createFromFormat(
            'd/m/Y',
            $validated['birthdate']
        )->format('Y-m-d');*/
        /*Update the model using the forceFill() and save() methods*/
//        $user->forceFill($validated)->save();

        return back()->with('status', 'Profile update successfully');
    }
}
