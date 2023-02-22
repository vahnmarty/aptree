<?php

namespace App\Http\Livewire\Tenant\Courses;

use App\Models\Course;
use Livewire\Component;
use Auth;

class ShowCourse extends Component
{
    public $course;
    public $is_enrolled;
    
    public function render()
    {
        return view('livewire.tenant.courses.show-course');
    }

    public function mount($id)
    {
        $this->course = Course::findOrFail($id);

        $this->is_enrolled = $this->course->users()->where('user_id', Auth::id())->exists();
    }

    public function start()
    {
        $pivot = Auth::user()->courses()->attach($this->course->id);

        // @TODO
        // Must redirect to pivot;

        return redirect()->route('courses.player', $this->course->id);
    }
}
