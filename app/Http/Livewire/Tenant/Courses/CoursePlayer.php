<?php

namespace App\Http\Livewire\Tenant\Courses;

use Auth;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Module;
use Livewire\Component;
use App\Models\ModuleItem;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CoursePlayer extends Component
{
    use LivewireAlert;
    
    public $course;
    public $module, $module_id;
    public $contents = [], $content_index = 0, $content;
    public $start = false, $end = false;
    public $selected_answer, $is_correct;

    protected $queryString = ['module_id'];

    protected $listeners = ['confirmedExit'];

    public function render()
    {
        return view('livewire.tenant.courses.course-player')->layout('theme::layouts.slider');
    }

    public function mount($id)
    {
        $this->course = Course::findOrFail($id);

        $this->module = $this->course->modules()->ordered()->first();

        $this->module_id = $this->module->id;

        $this->contents = $this->parseContents($this->module);
    }

    public function parseContents(Module $module)
    {
        $data = [];

        foreach($module->items()->ordered()->get() as $item)
        {
            $item['is_complete'] = $this->hasRecord($item);

            $data[] = $item;
        }

        return $data;
    }

    public function hasRecord(ModuleItem $item)
    {
        return $item->users()->where('user_id', Auth::id())->first() ? true : false;
    }

    public function start()
    {
        $this->start = true;

        $content_id = $this->contents[$this->content_index]['id'];

        $this->setContent($content_id);
    }

    public function next()
    {
        $module_item = ModuleItem::find($this->content['id']);

        $record = $module_item->users()->where('user_id', Auth::id())->first();
    
        if(!$record){
            $module_item->users()->attach(Auth::id(), ['completed_at' => now()]);
        }

        $this->content_index += 1;

        if(!empty($this->contents[$this->content_index]['id'])){
            $content_id = $this->contents[$this->content_index]['id'];
        }else{
            return $this->end = true;
        }
        
        
        $this->setContent($content_id);
        
    }

    public function selectAnswer($answerId)
    {
        $answer = Answer::find($answerId);

        $record = $answer->users()->where('user_id', Auth::id())->first();
        
        if(!$record)
        {
            $answer->users()->attach(Auth::id(), ['is_correct' => $answer->is_correct, 'completed_at' => now()]);
        }
        
        $this->selected_answer = $answerId;
        $this->is_correct = $answer->is_correct;
    }

    public function setContent($content_id)
    {
        $this->content = ModuleItem::find($content_id);
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
}
