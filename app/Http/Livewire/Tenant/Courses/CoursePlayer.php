<?php

namespace App\Http\Livewire\Tenant\Courses;

use Auth;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Module;
use Livewire\Component;
use App\Models\Enrollment;
use App\Models\ModuleItem;
use App\Models\EnrollmentModule;
use App\Models\EnrollmentModuleItem;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CoursePlayer extends Component
{
    use LivewireAlert;
    
    public Enrollment $enrollment;
    public Course $course;

    public $module, $module_id;
    public $contents = [], $content_index = 0, $content;
    public $start = false, $end = false;
    public $selected_answer, $is_correct;

    public EnrollmentModuleItem $episode;
    public $enrollment_module;

    public $items_completed = 0, $items_missed = 0, $next_module;

    protected $queryString = ['module_id', 'enrollment_module'];

    protected $listeners = ['confirmedExit'];

    public function render()
    {
        return view('livewire.tenant.courses.course-player')->layout('theme::layouts.slider');
    }

    public function mount($uuid)
    {
        $this->enrollment = Enrollment::whereUuid($uuid)->firstOrFail();

        $this->course = $this->enrollment->course;

        $this->module = $this->course->modules()->ordered()->first();

        $this->module_id = $this->module->id;

        $this->contents = $this->module->items()->ordered()->get();
    }


    public function start()
    {
        $this->start = true;

        # Init Module
        $module_record = EnrollmentModule::firstOrCreate([
                'enrollment_id' => $this->enrollment->id,
                'module_id' => $this->module_id
        ]);

        # Update start_at
        if($module_record){
            $module_record->start_at = now();
            $module_record->save();
        }

        $this->enrollment_module = $module_record->uuid;

        return $this->startFirstEpisode();
    }
    
    public function startFirstEpisode()
    {
        $enrollment_module = EnrollmentModule::with('module')->whereUuid($this->enrollment_module)->firstOrFail();

        $module = $enrollment_module->module;

        $firstEpisode = $module->items()->ordered()->first();

        return $this->showNext($firstEpisode->id);
    }

    public function finish()
    {
        $this->end = true;

        # Init Module
        $module_record = EnrollmentModule::whereUuid($this->enrollment_module)->first();
        $module = $module_record->module;
        $enrollment = $this->enrollment;
        $course = $enrollment->course;
        $course_modules = $course->modules->pluck('id');

        # Update start_at
        $module_record->completed_at = now();
        $module_record->save();

        # Module Stats
        $this->items_completed = $module_record->items()->whereNotNull('completed_at')->count();
        $this->items_missed = $module_record->items()->where('is_correct', false)->count();

        # Check for Available Modules

        foreach($course_modules as $module_id)
        {
            $record = EnrollmentModule::where('enrollment_id', $enrollment->id)->where('module_id', $module_id)->first();

            if(!$record){
                $this->next_module = $this->nextModule($record->module_id);
            }
        }

        if(!$this->next_module)
        {
            $enrollment->completed_at = now();
            $enrollment->save();
        }
    }

    public function nextModule(Module $module)
    {
        

    }

    public function showNext($module_item_id)
    {
        $enrollment_module = EnrollmentModule::whereUuid($this->enrollment_module)->firstOrFail();
        $module_item = ModuleItem::find($module_item_id);

        # Record
        $record = EnrollmentModuleItem::with('moduleItem')->firstOrCreate([
                'enrollment_id' => $this->enrollment->id, 
                'enrollment_module_id' => $enrollment_module->id,
                'module_item_id' => $module_item->id
        ]);
        
        $this->episode = $record;

        $this->content = $record->moduleItem;
        
    }

    public function submitNext()
    {
        # Update completion
        $record = EnrollmentModuleItem::find($this->episode['id']);
        $record->completed_at = now();
        $record->save();

        # Check for next item
        $index = $this->content_index += 1;

        if(!empty($this->contents[$index]))
        {   
            $nextModuleItem = $this->contents[$index];

            return $this->showNext($nextModuleItem['id']);
        }

        # Module Finish
        return $this->finish();
    }


    public function selectAnswer($answerId)
    { 
        # Answer  
        $answer = Answer::find($answerId);

        # Save Result
        $record = EnrollmentModuleItem::find($this->episode['id']);
        $record->answer_id = $answer->id;
        $record->is_correct = $answer->is_correct;
        $record->completed_at = now();
        $record->save();
        
        # Display
        $this->selected_answer = $answerId;
        $this->is_correct = $answer->is_correct;
    }

    

    public function exit()
    {
        $this->confirm("Are you sure you want to exit from this lesson?", [
            'text' => 'This will redirect you the course page.',
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedExit' 
        ]);
    }

    public function confirmedExit()
    {
        return redirect()->route('courses.show', $this->course->id);
    }

    public function close()
    {
        return $this->confirmedExit();
    }
}
