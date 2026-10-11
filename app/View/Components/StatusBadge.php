<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusBadge extends Component
{
    public function __construct(public string $status) {}

    public function render(): View
    {
        return view('components.status-badge');
    }
}
