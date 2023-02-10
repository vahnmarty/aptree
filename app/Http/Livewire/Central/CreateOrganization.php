<?php

namespace App\Http\Livewire\Central;

use Wave\Plan;
use App\Models\Tenant;
use Livewire\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Auth;

class CreateOrganization extends Component implements HasForms 
{
    use InteractsWithForms;

    public $name, $plan;

    public function render()
    {
        return view('livewire.central.create-organization');
    }

    protected function getFormSchema(): array 
    {
        return [
            TextInput::make('name')->required(),
            Select::make('plan')->options(Plan::get()->pluck('name', 'id'))->required(),
        ];
    } 

    public function submit(): void
    {
        $data = $this->form->getState();
        

        $tenant = Tenant::create([
            'plan_id' => $data['plan'],
            'user_id' => Auth::id(),
            'name' => $data['name']
        ]);

        $tenant->domains()->create(['domain' => $this->generateDomain($tenant->id)]);

        $this->dispatchBrowserEvent('closemodal-create');
        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => 'Organization created successfully!']);
    }

    public function generateDomain($tenant)
    {
        return $tenant . '.' . config('app.domain');
    }
}
