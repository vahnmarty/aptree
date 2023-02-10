<?php

namespace App\Http\Livewire\Central;

use Auth;
use Wave\Plan;
use Faker\Factory;
use App\Models\Tenant;
use Livewire\Component;
use App\Models\TenantUser;
use Spatie\Permission\Models\Role;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Database\Seeders\TenantUsersTableSeeder;
use Filament\Forms\Concerns\InteractsWithForms;

class EditOrganization extends Component implements HasForms 
{
    use InteractsWithForms;

    public Tenant $tenant, $name;

    public function render()
    {
        return view('livewire.central.create-organization');
    }

    public function mount($id)
    {
        $this->tenant = Tenant::find($id);

        // $this->form->fill([
        //     'name' => $this->tenant->name
        // ]);
    }
    
    protected function getFormSchema(): array 
    {
        return [
            TextInput::make('name')->required(),
        ];
    } 

    public function submit(): void
    {
        $data = $this->form->getState();
        
        $faker = Factory::create();
        $app_name = $faker->domainWord . '-' . $faker->domainWord;

        // Create Tenant
        $tenant = Tenant::create([
            'id' => $app_name,
            'plan_id' => $data['plan'],
            'user_id' => Auth::id(),
            'name' => $data['name']
        ]);

        $this->dispatchBrowserEvent('closemodal-edit');
        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => 'Organization updated successfully!']);
    }
}
