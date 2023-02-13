<?php

namespace App\Http\Livewire\Tenant\Courses;

use App\Models\Module;
use Livewire\Component;
use Filament\Forms\Components\Grid;
use App\Forms\Components\SelectIcon;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateModule extends Component implements HasForms
{
    use InteractsWithForms;

    public $title, $icon, $description;

    public $tenant;
    
    public function render()
    {   
        return view('livewire.tenant.courses.create-module');
    }

    public function mount($id)
    {
        $this->course_id = $id;
        $this->tenant = tenant();
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(5)
            ->schema([
                TextInput::make('title')->columnSpan('full'),
                Textarea::make('description')->columnSpan('full')
            ])
        ];
    }

    public function submit()
    {
        $data = $this->validate();

        $this->tenant->run(function() use($data){
            $module = new Module;
            $module->course_id = $this->course_id;
            $module->fill($data);
            $module->save();
        });

        $this->emit('toast', ['type' => 'success', 'message' => 'Module created successfully!']);

        $this->dispatchBrowserEvent('closemodal-module-create');
        
        $this->emitUp('refreshParent');
    }
}