<?php

namespace App\Livewire;

use Livewire\Component;

class Navlink extends Component
{
    public string $name;
    public string $route="dashboard";
    public string $isActive;




    public function render()
    {
        return view('livewire.navlink');
    }
}
