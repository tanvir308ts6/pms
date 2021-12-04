<?php

namespace App\Http\Controllers\User;

use App\Helpers\DateHelper;
use App\Helpers\PasswordHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserInformationRequest;
use App\Http\Requests\User\UserInformationRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PrisonerController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-prisoners');
        $this->middleware('verify.user.role:prisoner')->except('index', 'create', 'store');
    }

    /*List of prisoners*/
    public function index(): View
    {
        $prisoner_role = Role::where('name', 'prisoner')->first();

        $prisoners = $prisoner_role->users();

        if (request('search')) {
            $prisoners = $prisoners->where('username', 'like', '%' . request('search') . '%');
        }

        $prisoners = $prisoners->orderBy('first_name', 'asc')
            ->orderBy('last_name', 'asc')
            ->paginate();

        return view('dashboard.prisoner.index', [
            'prisoners' => $prisoners,
        ]);
    }

    /*Prisoner creation form*/
    public function create(): view
    {
        return view('dashboard.prisoner.create');
    }

    /*Save the prisoner's record*/
    public function store(UserInformationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $password_generated = PasswordHelper::generatePassword();

        $prisoner_role = Role::where('name', 'prisoner')->first();

        $prisoner = $prisoner_role->users()->create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'birthdate' => DateHelper::verifyDateFormat($validated['birthdate']),
            'phone_number' => $validated['phone_number'],
            'home_phone_number' => $validated['home_phone_number'],
            'address' => $validated['address'],
            'password' => Hash::make($password_generated),
        ]);

        $prisoner->image()->create([
            'path' => $prisoner->generateAvatarUrl(),
        ]);

        return back()->with('status', 'Prisoner created successfully');
    }

    /*Display the data of a specific prisoner */
    public function show(User $user): View
    {
        return view('dashboard.prisoner.show', [
            'prisoner' => $user,
        ]);
    }

    /*Prisoner actualization form*/
    public function edit(User $user): View
    {
        return view('dashboard.prisoner.update', [
            'prisoner' => $user
        ]);
    }

    /*Save the update of the prisoner's record*/
    public function update(UpdateUserInformationRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        $prisoner = $user;
        $prisoner->first_name = $validated['first_name'];
        $prisoner->last_name = $validated['last_name'];
        $prisoner->username = $validated['username'];
        $prisoner->email = $validated['email'];
        $prisoner->birthdate = DateHelper::verifyDateFormat($validated['birthdate']);
        $prisoner->phone_number = $validated['phone_number'];
        $prisoner->home_phone_number = $validated['home_phone_number'];
        $prisoner->address = $validated['address'];
        $prisoner->save();

        $prisoner->updateUIAvatar($prisoner->generateAvatarUrl());

        return back()->with('status', 'Prisoner updated successfully');
    }

    /*Prisoner's logic deleted*/
    public function destroy(User $user): RedirectResponse
    {
        $prisoner = $user;
        $state = $prisoner->state;
        $message = $state ? 'inactivated' : 'activated';

        $prisoner->state = !$state;
        $prisoner->save();

        return back()->with('status', "Prisoner $message successfully");
    }
}
