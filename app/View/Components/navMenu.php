<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class navMenu extends Component
{
    public string $name;
    public bool $secondList;
    public string  $secondSlot;
    public function __construct(string $name, bool $secondList = false, string $secondSlot = '')
    {
        $this->name = $name;
        $this->secondList = $secondList;
        $this->secondSlot = $secondSlot;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-menu');
    }
}
