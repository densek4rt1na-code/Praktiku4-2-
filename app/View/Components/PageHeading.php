<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeading extends Component
{
    public function __construct(
        public string $title,
        public string $description,
        public string $eyebrow = 'KELOLA DATA SMART MARITIM',
        public ?string $actionUrl = null,
        public ?string $actionLabel = null,
    ) {}

    public function render(): View
    {
        return view('components.page-heading');
    }
}
