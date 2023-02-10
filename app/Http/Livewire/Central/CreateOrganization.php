<?php

namespace App\Http\Livewire\Central;

use Auth;
use Wave\Plan;
use Faker\Factory;
use App\Models\User;
use App\Models\Tenant;
use Livewire\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Database\Seeders\TenantUsersTableSeeder;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\Role;

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
        try {
            $tenant->run(function() use($user) {
                $this->createRoles();
                $tenant_user = User::create($user->only('name', 'email', 'password', 'email_verified_at'));
                $tenant_user->setRole('admin');
                
            });
    
            $this->dispatchBrowserEvent('closemodal-create');
            $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => 'Organization created successfully!']);

            $this->emitUp('refreshParent');
            
        } catch (\Throwable $th) {

            $tenant->delete();
            throw $th;
        }
        
    }

    public function generateDomain($tenant)
    {
        return $tenant . '.' . config('app.domain');
    }

    public function createRoles()
    {
        $role = Role::create(['name' => 'admin', 'display_name' => 'Admin']);
        $role = Role::create(['name' => 'instructor', 'display_name' => 'Instructor']);
        $role = Role::create(['name' => 'student', 'display_name' => 'Student']);
    }
}
