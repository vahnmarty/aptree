<?php

namespace App\Http\Livewire\Tenant\Courses;

use Livewire\Component;

class CoursePlayer extends Component
{
    public function render()
    {
        return view('livewire.tenant.courses.course-player')->layout('theme::layouts.slider');
    }
}
