<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\ReportInformationRequest;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Report::class, 'report');
    }

    public function index(): View
    {
        $guard = Auth::user();
        $reports = $guard->reports();

        if (request('search')) {
            $reports = $reports->where('title', 'like', '%' . request('search') . '%');
        }

        $reports = $reports->orderBy('title', 'asc')
            ->paginate();

        return view('dashboard.report.index', [
            'reports' => $reports,
        ]);
    }

    public function create(): View
    {
        return view('dashboard.report.create');
    }

    public function store(ReportInformationRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $guard = Auth::user();

        $report = new Report();
        $report->title = $validated['title'];
        $report->description = $validated['description'];

        $guard->reports()->save($report);

        if ($request->has('image')) {
            $report->storeImage($validated['image'], 'reports');
        }

        return back()->with('status', 'Report created successfully');
    }

    public function show(Report $report): View
    {
        return view('dashboard.report.show', [
            'report' => $report,
        ]);
    }

    public function edit(Report $report): View
    {
        return view('dashboard.report.update', [
            'report' => $report
        ]);
    }

    public function update(ReportInformationRequest $request, Report $report): RedirectResponse
    {
        $validated = $request->validated();

        $report->title = $validated['title'];
        $report->description = $validated['description'];
        $report->save();

        if ($request->has('image')) {
            $report->updateImage($validated['image'], 'reports');
        }

        return back()->with('status', 'Report updated successfully');
    }

    public function destroy(Report $report): RedirectResponse
    {
        $state = $report->state;
        $message = $state ? 'inactivated' : 'activated';

        $report->state = !$state;
        $report->save();

        return back()->with('status', "Report $message successfully");
    }
}
