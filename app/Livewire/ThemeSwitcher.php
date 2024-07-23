<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class ThemeSwitcher extends Component
{
    public array $themes;
    public string $activeTheme;

    public function mount()
    {
        $this->themes = [
            'light', 'dark', 'cupcake', 'bumblebee', 'emerald', 'corporate', 'synthwave',
            'retro', 'cyberpunk', 'valentine', 'halloween', 'garden', 'forest', 'aqua', 'lovely'
        ];

        $this->activeTheme = Session::get('activeTheme', 'light');
    }

    public function changeActiveTheme($theme)
    {
        $this->activeTheme = $theme;

        // Enregistrement de la valeur en session
        Session::put('activeTheme', $theme);
    }

    public function render()
    {
        return view('livewire.theme-switcher');
    }
}
