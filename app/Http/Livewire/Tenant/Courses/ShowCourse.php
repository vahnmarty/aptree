<?php

namespace App\Http\Livewire\Tenant\Courses;

use Auth;
use App\Models\Course;
use Livewire\Component;
use App\Models\Enrollment;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Str;

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

        $this->is_enrolled = Enrollment::whereUserId(Auth::id())->whereCourseId($id)->exists();
    }

    public function start()
    {

        if(!$this->course->modules()->count()){
            return $this->alert('error', 'This course has no modules');
        }

        if($this->is_enrolled){
            $enroll = Enrollment::whereUserId(Auth::id())->whereCourseId($this->course->id)->first();
        }else{
            $enroll = new Enrollment;
            $enroll->user_id = Auth::id();
            $enroll->course_id = $this->course->id;
            $enroll->save();
        }
        

        return redirect()->route('courses.play', $enroll->uuid);
    }
}
