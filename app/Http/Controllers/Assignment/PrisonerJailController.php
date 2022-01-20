<?php

namespace App\Http\Controllers\Assignment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Assignment\PrisonerJailRequest;
use App\Models\Jail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PrisonerJailController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-assignment');
        $this->middleware('active.user')->except('index');
        $this->middleware('verify.user.role:prisoner')->except('index');
    }

    public function index(): View
    {
        $prisoner_role = Role::where('name', 'prisoner')->first();

        $prisoners = $prisoner_role->users();

        if (request('search')) {
            $prisoners = $prisoners->where('username', 'like', '%' . request('search') . '%');
        }

        $prisoners = $prisoners
            ->orderBy('first_name', 'asc')
            ->orderBy('last_name', 'asc')
            ->paginate();

        $jails = Jail::orderBy('name', 'asc')
            ->cursor()->filter(function ($jail) {
            return $jail->capacity > $jail->users->count() && $jail->state;
        });

        return view('dashboard.assignment.prisoners-jails', [
            'prisoners' => $prisoners,
            'jails' => $jails->all()
        ]);
    }

    public function update(PrisonerJailRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();
        $prisoner = $user;

        if ($this->verifyItIsTheSameJail($prisoner->jails->first(), $validated['jail'])) {
            return back()->with([
                'status' => 'The prisoner is already in that jail.',
                'color' => 'yellow'
            ]);
        }

        //First, all user's jail relations are deactivated
        $prisoner_jails_id = $prisoner->jails->modelKeys();
        $prisoner->jails()->syncWithPivotValues($prisoner_jails_id, ['state' => false]);

        //Second, a new assigment is saved between user and jail
        $prisoner->jails()->sync($validated['jail']);

        return back()->with('status', 'Assignment updated successfully');
    }

    private function verifyItIsTheSameJail(Jail|null $jail, string $jail_id): bool
    {
        return !is_null($jail) && $jail->id === (int)$jail_id;
    }
}
