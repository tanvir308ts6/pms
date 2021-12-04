<?php

namespace App\Http\Controllers\Assignment;

use App\Http\Controllers\Controller;

class GuardWardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-assignment');
    }

    public function index()
    {
        return "Guard to ward";
    }
}
