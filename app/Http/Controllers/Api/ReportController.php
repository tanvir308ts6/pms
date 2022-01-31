<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReportController extends Controller
{
    /**
     * Returns report list
     */
    public function list_reports(): AnonymousResourceCollection
    {
        $reports = Report::where('state', true)->get();
        return ReportResource::collection($reports);
    }
}
