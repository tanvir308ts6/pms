<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;


class AuthLayout extends Component
{
    public string $primaryColor;
    public string $secondaryColor;
    public bool $reversColumns;

    public function __construct(
        string $primaryColor = "green",
        string $secondaryColor = "blue",
        bool   $reversColumns = false)
    {
        $this->primaryColor = $primaryColor;
        $this->secondaryColor = $secondaryColor;
        $this->reversColumns = $reversColumns;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('layouts.auth');
    }
}
