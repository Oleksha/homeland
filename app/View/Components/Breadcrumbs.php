<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Breadcrumbs extends Component
{
    public function __construct(
        public array $items = []
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.breadcrumbs');
    }
}

