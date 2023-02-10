<?php

namespace App\Http\Livewire\Central;

use Auth;
use Wave\Plan;
use Faker\Factory;
use App\Models\Tenant;
use Livewire\Component;
use App\Models\TenantUser;
use Spatie\Permission\Models\Role;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Database\Seeders\TenantUsersTableSeeder;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateOrganization extends Component implements HasForms 
{
    use InteractsWithForms;

    public $name, $plan;

    public function render()
    {
        return view('livewire.central.create-organization');
    }

    public function mount()
    {
        $this->form->fill([
            'plan' => Plan::first()->id
        ]);
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
        
        $faker = Factory::create();
        $app_name = $faker->domainWord . '-' . $faker->domainWord;

        // Create Tenant
        $tenant = Tenant::create([
            'id' => $app_name,
            'plan_id' => $data['plan'],
            'user_id' => Auth::id(),
            'name' => $data['name']
        ]);

        // Add Domain
        $tenant->domains()->create(['domain' => $this->generateDomain($tenant->id)]);

        // Add Default User
        $user = Auth::user();
        $tenant->run(function() use($user) {

            // Create Tenant User
            // $tenant_user = new TenantUser;
            // $tenant_user->name = $user->name;
            // $tenant_user->email = $user->email;
            // $tenant_user->password = $user->password;
            // $tenant_user->save();

            // $this->createRoles();
            // $tenant_user->assignRole('admin');
            
        });

        $this->dispatchBrowserEvent('closemodal-create');
        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => 'Organization created successfully!']);
    }

    public function generateDomain($tenant)
    {
        return $tenant . '.' . config('app.domain');
    }

    public function createRoles()
    {
        $role = Role::firstOrCreate(['name' => 'admin']);
        $role = Role::firstOrCreate(['name' => 'instructor']);
        $role = Role::firstOrCreate(['name' => 'student']);
    }
}
