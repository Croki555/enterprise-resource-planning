<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public string $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function render(): View|Closure|string
    {
        return view('layouts.app');
    }
}
