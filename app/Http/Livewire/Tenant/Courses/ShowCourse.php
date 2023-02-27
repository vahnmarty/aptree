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
    public $enrollment_record;
    
    public function render()
    {
        return view('livewire.tenant.courses.show-course');
    }

    public function mount($id)
    {
        $this->course = Course::findOrFail($id);

        $this->enrollment_record = Enrollment::whereUserId(Auth::id())->whereCourseId($id)->first();
    }

    public function start()
    {

        if(!$this->course->modules()->count()){
            return $this->alert('error', 'This course has no modules');
        }

        if($this->enrollment_record){
            $enroll = $this->enrollment_record;
        }else{
            $enroll = new Enrollment;
            $enroll->user_id = Auth::id();
            $enroll->course_id = $this->course->id;
            $enroll->save();
        }
        

        return redirect()->route('courses.play', $enroll->uuid);
    }
}
