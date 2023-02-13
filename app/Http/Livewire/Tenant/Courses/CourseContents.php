<?php

namespace App\Http\Livewire\Tenant\Courses;

use App\Models\Course;
use App\Models\Module;
use Livewire\Component;

class CourseContents extends Component
{
    public $course;

    public $module_id;

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
        $this->module_id = $id;
        $this->module = Module::find($id);
    }
}
