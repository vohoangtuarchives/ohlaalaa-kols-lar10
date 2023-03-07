<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Settings extends Component
{
    public $setting = 'general';

    public $active;

    public function __construct()
    {
        $this->active['general'] = 'active';
    }

    public function render()
    {
        return view('livewire.dashboard.settings');
    }

    public function select($component){
        $this->setting = $component;
        $this->active = null;
        $this->active[$component] = 'active';
    }
}
