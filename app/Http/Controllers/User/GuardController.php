<?php

namespace App\Http\Controllers\User;

use App\Helpers\DateHelper;
use App\Helpers\PasswordHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserInformationRequest;
use App\Http\Requests\User\UserInformationRequest;
use App\Models\Role;
use App\Models\User;
use App\Notifications\RegisteredUserNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class GuardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-guards');
        $this->middleware('verify.user.role:guard')->except('index', 'create', 'store');
    }

    /*List of guards*/
    public function index(): View
    {
        $guard_role = Role::where('name', 'guard')->first();

        $guards = $guard_role->users();

        if (request('search')) {
            $guards = $guards->where('username', 'like', '%' . request('search') . '%');
        }

        $guards = $guards->orderBy('first_name', 'asc')
            ->orderBy('last_name', 'asc')
            ->paginate();

        return view('dashboard.guard.index', [
            'guards' => $guards,
        ]);
    }

    /*Guard creation form*/
    public function create(): view
    {
        return view('dashboard.guard.create');
    }

    /*Save the guard's record*/
    public function store(UserInformationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $password_generated = PasswordHelper::generatePassword();

        $guard_role = Role::where('name', 'guard')->first();

        $guard = $guard_role->users()->create([
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

        $guard->image()->create([
            'path' => $guard->generateAvatarUrl(),
        ]);

        $guard->notify(
            new RegisteredUserNotification(
                $guard->getFullName(),
                $guard_role->name,
                $password_generated
            )
        );

        return back()->with('status', 'Guard created successfully');
    }

    /*Display the data of a specific guard */
    public function show(User $user): View
    {
        return view('dashboard.guard.show', [
            'guard' => $user,
        ]);
    }

    /*Guard actualization form*/
    public function edit(User $user): View
    {
        return view('dashboard.guard.update', [
            'guard' => $user
        ]);
    }

    /*Save the update of the guard's record*/
    public function update(UpdateUserInformationRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        $old_email = $user->email;

        $guard = $user;
        $guard->first_name = $validated['first_name'];
        $guard->last_name = $validated['last_name'];
        $guard->username = $validated['username'];
        $guard->email = $validated['email'];
        $guard->birthdate = DateHelper::verifyDateFormat($validated['birthdate']);
        $guard->phone_number = $validated['phone_number'];
        $guard->home_phone_number = $validated['home_phone_number'];
        $guard->address = $validated['address'];
        $guard->save();

        $guard->updateUIAvatar($guard->generateAvatarUrl());

        $this->verifyEmailChange($guard, $old_email);

        return back()->with('status', 'Guard updated successfully');
    }

    /*Guard's logic deleted*/
    public function destroy(User $user): RedirectResponse
    {
        $guard = $user;
        $state = $guard->state;
        $message = $state ? 'inactivated' : 'activated';

        if ($state) {
            $this->disableAllGuardRelationshipsWithWards($guard);
        }

        $guard->state = !$state;
        $guard->save();

        return back()->with('status', "Guard $message successfully");
    }

    private function verifyEmailChange(User $guard, string $old_email): void
    {
        if ($guard->email !== $old_email) {
            $password_generated = PasswordHelper::generatePassword();
            $guard->password = Hash::make($password_generated);
            $guard->save();

            $guard->notify(
                new RegisteredUserNotification(
                    $guard->getFullName(),
                    $guard->role->name,
                    $password_generated
                )
            );
        }
    }

    private function disableAllGuardRelationshipsWithWards(User $guard): void
    {
        //All ward relationships are deactivated.
        $guard_wards_id = $guard->wards->modelKeys();
        $guard->wards()->syncWithPivotValues($guard_wards_id, ['state' => false]);
    }
}
