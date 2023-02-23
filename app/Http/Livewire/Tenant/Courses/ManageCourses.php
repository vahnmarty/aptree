<?php

namespace App\Http\Livewire\Tenant\Courses;

use App\Models\Course;
use Livewire\Component;
use Auth;

class ManageCourses extends Component
{
    public $filter;

    public $courses = [];

    protected $queryString = ['filter'];

    public function render()
    {
        return view('livewire.tenant.courses.manage-courses');
    }

    public function mount()
    {

        $this->courses = Course::latest()->get();
    }
}
