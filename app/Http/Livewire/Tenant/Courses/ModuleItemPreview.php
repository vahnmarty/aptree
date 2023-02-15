<?php

namespace App\Http\Livewire\Tenant\Courses;

use Livewire\Component;
use App\Models\ModuleItem;

class ModuleItemPreview extends Component
{
    public $module;

    public function render()
    {
        return view('livewire.tenant.courses.module-item-preview')->layout('theme::layouts.slider');
    }

    public function mount($id)
    {
        $this->module = ModuleItem::find($id);
    }
}
