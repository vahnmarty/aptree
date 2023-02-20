<?php

namespace App\Http\Livewire\Tenant\Courses;

use App\Models\Course;
use Livewire\Component;

class CoursePlayer extends Component
{
    public $course;
    public $module, $module_id;

    public function render()
    {
        return view('livewire.tenant.courses.course-player')->layout('theme::layouts.slider');
    }

    public function mount($id)
    {
        $this->course = Course::findOrFail($id);

        $this->module = $this->course->modules()->first();
    }
}
