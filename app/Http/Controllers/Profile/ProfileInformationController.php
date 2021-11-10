<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProfileInformationController extends Controller
{
    public function create(): view
    {
        return view('profile.show');
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate(['first_name' => 'min:3|max:5']);
        return back()->with('status', 'Profile update successfully');
    }
}
