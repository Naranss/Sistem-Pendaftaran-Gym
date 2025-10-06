<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class Category extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label,
        public string $route = '#'
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.category');
    }

    /**
     * Determine if the icon slot has been filled.
     */
    public function shouldRenderIcon(): bool
    {
        return isset($this->icon);
    }
}