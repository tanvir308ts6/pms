<?php

namespace App\Http\Controllers\Jail;

use App\Http\Controllers\Controller;
use App\Http\Requests\Jail\JailInformationRequest;
use App\Models\Jail;
use App\Models\Ward;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class JailController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-jails');
    }

    public function index(): View
    {
        $jails = Jail::query();

        if (request('search')) {
            $jails = $jails->where('name', 'like', '%' . request('search') . '%');
        }

        $jails = $jails->orderBy('name', 'asc')
            ->paginate();

        return view('dashboard.jail.index', [
            'jails' => $jails,
        ]);
    }

    public function create(): View
    {
        $wards = Ward::all();
        return view('dashboard.jail.create', [
            'wards' => $wards
        ]);
    }

    public function store(JailInformationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $jail = new Jail();

        $jail->name = $validated['name'];
        $jail->code = $validated['code'];
        $jail->type = $validated['type'];
        $jail->capacity = $validated['capacity'];
        $jail->ward_id = $validated['ward'];
        $jail->description = $validated['description'];
        $jail->save();

        return back()->with('status', 'Jail created successfully');
    }

    public function show(Jail $jail): View
    {
        return view('dashboard.jail.show', [
            'jail' => $jail,
        ]);
    }

    public function edit(Jail $jail): View
    {
        $wards = Ward::all();
        return view('dashboard.jail.update', [
            'jail' => $jail,
            'wards' => $wards,
        ]);
    }

    public function update(JailInformationRequest $request, Jail $jail): RedirectResponse
    {
        $validated = $request->validated();

        $jail->name = $validated['name'];
        $jail->code = $validated['code'];
        $jail->type = $validated['type'];
        $jail->capacity = $validated['capacity'];
        $jail->ward_id = $validated['ward'];
        $jail->description = $validated['description'];
        $jail->save();

        return back()->with('status', 'Jail updated successfully');
    }

    public function destroy(Jail $jail): RedirectResponse
    {
        $state = $jail->state;
        $message = $state ? 'inactivated' : 'activated';

        $jail->state = !$state;
        $jail->save();

        return back()->with('status', "Jail $message successfully");
    }
}
