<?php

namespace App\Http\Livewire\Tenant\Courses;

use App\Models\Course;
use App\Models\Module;
use Livewire\Component;

class CourseContents extends Component
{
    public $course;

    public $module_id, $selected_module;

    protected $listeners = [ 'refreshParent' => '$refresh'];

    public function render()
    {
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
}
