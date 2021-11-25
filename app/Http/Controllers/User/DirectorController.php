<?php

namespace App\Http\Controllers\User;


use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserInformationRequest;
use App\Http\Requests\User\UserInformationRequest;
use App\Models\Role;
use App\Helpers\PasswordHelper;
use App\Models\User;
use App\Notifications\RegisteredUserNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class DirectorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-directors');
        $this->middleware('verify.user.role:director')->except('index', 'create', 'store', 'search');
    }

    /*List of directors*/
    public function index(): View
    {
        $director_role = Role::where('name', 'director')->first();

        $directors = $director_role->users()
            ->orderBy('first_name', 'asc')
            ->orderBy('last_name', 'asc')
            ->paginate();

        return view('dashboard.director.index', [
            'directors' => $directors,
        ]);
    }

    /*Director creation form*/
    public function create(): view
    {
        return view('dashboard.director.create');
    }

    /*Save the director's record*/
    public function store(UserInformationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $password_generated = PasswordHelper::generatePassword();

        $director_role = Role::where('name', 'director')->first();

        $director = $director_role->users()->create([
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

        $director->image()->create([
            'path' => $director->generateAvatarUrl(),
        ]);

        $director->notify(
            new RegisteredUserNotification(
                $director->getFullName(),
                $director_role->name,
                $password_generated
            )
        );

        return back()->with('status', 'Director created successfully');
    }

    /*Display the data of a specific director */
    public function show(User $user): View
    {
        return view('dashboard.director.show', [
            'director' => $user,
        ]);
    }

    /*Director actualization form*/
    public function edit(User $user): View
    {
        return view('dashboard.director.update', [
            'director' => $user
        ]);
    }

    /*Save the update of the director's record*/
    public function update(UpdateUserInformationRequest $request, User $user)
    {
        $validated = $request->validated();

        $old_email = $user->email;

        $director = $user;
        $director->first_name = $validated['first_name'];
        $director->last_name = $validated['last_name'];
        $director->username = $validated['username'];
        $director->email = $validated['email'];
        $director->birthdate = DateHelper::verifyDateFormat($validated['birthdate']);
        $director->phone_number = $validated['phone_number'];
        $director->home_phone_number = $validated['home_phone_number'];
        $director->address = $validated['address'];
        $director->save();

        $director->updateUIAvatar($director->generateAvatarUrl());

        $this->verifyEmailChange($director, $old_email);

        return back()->with('status', 'Director updated successfully');
    }

    /*Director's logic deleted*/
    public function destroy(User $user): RedirectResponse
    {
        $director = $user;
        $state = $director->state;
        $message = $state ? 'inactivated' : 'activated';

        $director->state = !$state;
        $director->save();

        return back()->with('status', "Director $message successfully");
    }

    public function search(): View
    {
        $director_role = Role::where('name', 'director')->first();

        //$directors = User::where('role_id', $director_role->id);
        $directors = $director_role->users();

        if (request('search')) {
            $directors = $directors->where('username', 'like', '%' . request('search') . '%');
        }

        $directors = $directors->orderBy('first_name', 'asc')
            ->orderBy('last_name', 'asc')
            ->paginate();

        return view('dashboard.director.index', [
            'directors' => $directors,
        ]);
    }

    private function verifyEmailChange(User $director, string $old_email): void
    {
        if ($director->email !== $old_email) {
            $password_generated = PasswordHelper::generatePassword();
            $director->password = Hash::make($password_generated);
            $director->save();

            $director->notify(
                new RegisteredUserNotification(
                    $director->getFullName(),
                    $director->role->name,
                    $password_generated
                )
            );
        }
    }
}
