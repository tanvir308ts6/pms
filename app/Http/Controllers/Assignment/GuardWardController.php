<?php

namespace App\Http\Controllers\Assignment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Assignment\GuardWardRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GuardWardController extends Controller
{
    private int $allowed_number_of_guards_per_ward = 2;

    public function __construct()
    {
        $this->middleware('can:manage-assignment');
        $this->middleware('active.user')->except('index');
        $this->middleware('verify.user.role:guard')->except('index');
    }

    public function index(): View
    {
        $guard_role = Role::where('name', 'guard')->first();

        $guards = $guard_role->users();

        if (request('search')) {
            $guards = $guards->where('username', 'like', '%' . request('search') . '%');
        }

        $guards = $guards
            ->orderBy('first_name', 'asc')
            ->orderBy('last_name', 'asc')
            ->paginate();

        $wards = Ward::orderBy('name', 'asc')
            ->cursor()->filter(function ($ward) {
            return $this->allowed_number_of_guards_per_ward > $ward->users->count() && $ward->state;
        });

        return view('dashboard.assignment.guards-wards', [
            'guards' => $guards,
            'wards' => $wards->all()
        ]);
    }

    public function update(GuardWardRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();
        $guard = $user;

        if ($this->verifyItIsTheSameWard($guard->wards->first(), $validated['ward'])) {
            return back()->with([
                'status' => 'The guard is already in that ward.',
                'color' => 'yellow'
            ]);
        }

        //First, all user's ward relations are deactivated
        $guard_wards_id = $guard->wards->modelKeys();
        $guard->wards()->syncWithPivotValues($guard_wards_id, ['state' => false]);

        //Second, a new assigment is saved between user and jail
        $guard->wards()->sync($validated['ward']);

        return back()->with('status', 'Assignment updated successfully');
    }

    private function verifyItIsTheSameWard(Ward|null $ward, string $ward_id): bool
    {
        return !is_null($ward) && $ward->id === (int)$ward_id;
    }
}
