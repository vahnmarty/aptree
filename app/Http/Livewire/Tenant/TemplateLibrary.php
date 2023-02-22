<?php

namespace App\Http\Livewire\Tenant;

use Livewire\Component;

class TemplateLibrary extends Component
{
    public $filter;
    
    public function render()
    {
        return view('livewire.tenant.template-library');
    }
}
