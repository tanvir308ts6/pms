<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class DashboardLayout extends Component
{
    public function render(): View|Factory|Application
    {
        return view('layouts.dashboard');
    }
}
