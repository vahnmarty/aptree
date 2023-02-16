<?php

namespace App\Http\Livewire\Tenant\Courses;

use App\Models\Course;
use App\Models\Module;
use Livewire\Component;
use App\Models\ModuleItem;
use App\Enums\ModuleItemType;

class CourseContents extends Component
{
    public $course;

    public $module_id, $selected_module;

    protected $queryString = ['module_id'];

    protected $listeners = [ 'refreshParent' => '$refresh'];

    public function render()
    {
        if($this->module_id)
        {
            $this->selectModule($this->module_id);
        }
        
        return view('livewire.tenant.courses.course-contents');
    }

    public function mount($id)
    {
        $this->course = Course::with('modules')->find($id);

        
    }

    public function selectModule($id)
    {
        $this->reset('selected_module');

        $this->module_id = $id;
        $this->selected_module = Module::find($id);
    }

    public function createContent($type)
    {
        // Emit to ContentEditor
        $this->emit('setContentType', $type);

        $this->dispatchBrowserEvent('openmodal-content');
    }

    public function editCard($module_item_id)
    {
        $module = ModuleItem::find($module_item_id);

        if($module->type->value == ModuleItemType::Content){
            $this->emit('editContent', $module_item_id);
        }

        if($module->type->value == ModuleItemType::Document){
            $this->emit('editDocument', $module_item_id);
        }
    }

    public function deleteCard($module_item_id)
    {
        ModuleItem::destroy($module_item_id);

        $this->emit('toast', ['type' => 'success', 'Deleted!']);
    }

    public function editModule($module_id)
    {
        $this->emit('editModule', $module_id);
    }

    public function deleteModule($module_id)
    {
        Module::destroy($module_id);

        return redirect()->route('courses.contents', $this->course->id);
    }
}
