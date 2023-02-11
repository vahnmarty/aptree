<?php

namespace App\Http\Livewire\Tenant\Courses;

use Livewire\Component;

class ManageCourses extends Component
{
    public $filter;

    protected $queryString = ['filter'];

    public function render()
    {
        return view('livewire.tenant.courses.manage-courses');
    }

    public function mount()
    {

    }
}
