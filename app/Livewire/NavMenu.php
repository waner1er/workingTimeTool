<?php

namespace App\Livewire;

use Livewire\Component;

class NavMenu extends Component
{
    public string $data;
    public function mount()
    {
        $this->data = 'Some data';
    }
    public function render()
    {
        return view('livewire.nav-menu');
    }
}
