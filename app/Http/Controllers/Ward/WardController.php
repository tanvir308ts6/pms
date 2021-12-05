<?php

namespace App\Http\Controllers\Ward;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ward\WardInformationRequest;
use App\Models\Ward;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-wards');
    }

    public function index(): View
    {
        $wards = Ward::query();

        if (request('search')) {
            $wards = $wards->where('name', 'like', '%' . request('search') . '%');
        }

        $wards = $wards->orderBy('name', 'asc')
            ->paginate();

        return view('dashboard.ward.index', [
            'wards' => $wards,
        ]);
    }

    public function create(): View
    {
        return view('dashboard.ward.create');
    }

    public function store(WardInformationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $ward = new Ward();

        $ward->name = $validated['name'];
        $ward->location = $validated['location'];
        $ward->description = $validated['description'];
        $ward->save();

        return back()->with('status', 'Ward created successfully');
    }

    public function show(Ward $ward): View
    {
        return view('dashboard.ward.show', [
            'ward' => $ward,
        ]);
    }

    public function edit(Ward $ward): View
    {
        return view('dashboard.ward.update', [
            'ward' => $ward
        ]);
    }

    public function update(WardInformationRequest $request, Ward $ward): RedirectResponse
    {
        $validated = $request->validated();

        $ward->name = $validated['name'];
        $ward->location = $validated['location'];
        $ward->description = $validated['description'];
        $ward->save();

        return back()->with('status', 'Ward updated successfully');
    }

    public function destroy(Ward $ward): RedirectResponse
    {
        $state = $ward->state;
        $message = $state ? 'inactivated' : 'activated';

        if ($this->verifyWardHasAssignedGuards($ward)) {
            return back()->with([
                'status' => "The ward $ward->name has assigned guards.",
                'color' => 'yellow'
            ]);
        }

        $ward->state = !$state;
        $ward->save();

        return back()->with('status', "Ward $message successfully");
    }

    private function verifyWardHasAssignedGuards(Ward $ward): bool
    {
        return (bool)$ward->users->count();
    }
}
