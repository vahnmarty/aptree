<?php

namespace App\Http\Livewire\Tenant;

use Livewire\Component;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class ManageTeams extends Component implements HasForms
{
    use InteractsWithForms;
    
    public function render()
    {
        return view('livewire.tenant.manage-teams');
    }
}
