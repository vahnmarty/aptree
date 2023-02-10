<?php

namespace App\Http\Livewire\Central;

use Livewire\Component;
use App\Models\Tenant;
use Auth;

class MyOrganization extends Component
{
    protected $listeners = ['refreshParent' => '$refresh'];

    public $tenants = [];

    public function render()
    {
        $this->getTenants();

        return view('livewire.central.my-organization');
    }

    public function mount()
    {

    }

    public function getTenants()
    {
        $this->tenants = Tenant::where('user_id', Auth::id())->get();
    }
}
