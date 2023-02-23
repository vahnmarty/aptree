<?php

namespace App\Http\Livewire\Tenant\Courses;

use Auth;
use App\Models\Course;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowCourse extends Component
{
    use LivewireAlert;
    
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

        if(!$this->course->modules()->count()){
            return $this->alert('error', 'This course has no modules');
        }

        $pivot = Auth::user()->courses()->attach($this->course->id);
        
        

        // @TODO
        // Must redirect to pivot;

        return redirect()->route('courses.play', $this->course->id);
    }
}
