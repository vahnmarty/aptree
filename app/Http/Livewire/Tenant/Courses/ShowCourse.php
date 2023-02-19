<?php

namespace App\Http\Livewire\Tenant\Courses;

use App\Models\Course;
use Livewire\Component;

class ShowCourse extends Component
{
    public $course;
    
    public function render()
    {
        return view('livewire.tenant.courses.show-course');
    }

    public function mount($id)
    {
        $this->course = Course::findOrFail($id);
    }
}
