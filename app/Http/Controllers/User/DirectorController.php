<?php

namespace App\Http\Controllers\User;


use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserInformationRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\Role;
use App\Helpers\PasswordHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class DirectorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-directors');
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
            'birthdate' => $validated['birthdate'],
            'phone_number' => $validated['phone_number'],
            'home_phone_number' => $validated['home_phone_number'],
            'address' => $validated['address'],
            'password' => Hash::make($password_generated),
        ]);

        $director->image()->create([
            'path' => $director->generateAvatarUrl(),
        ]);

        //TODO: send an email to the created user

        return back()->with('status', 'Director created successfully');
    }

    /*Display the data of a specific director */
    public function show($id)
    {
        //
    }

    /*Director actualization form*/
    public function edit($id)
    {
        //
    }

    /*Save the update of the director's record*/
    public function update(Request $request, $id)
    {
        //
    }

    /*Director's logic deleted*/
    public function destroy($id)
    {
        //
    }

    private function verifyDateFormat(?string $date): ?string
    {
        return isset($date)
            ? DateHelper::changeDateFormat($date, 'd/m/Y')
            : null;
    }
}
