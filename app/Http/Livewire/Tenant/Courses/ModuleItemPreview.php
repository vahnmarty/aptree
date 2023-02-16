<?php

namespace App\Http\Livewire\Tenant\Courses;

use App\Models\Answer;
use Livewire\Component;
use App\Models\ModuleItem;

class ModuleItemPreview extends Component
{
    public $module;

    public $selected_answer, $is_correct;

    public function render()
    {
        return view('livewire.tenant.courses.module-item-preview')->layout('theme::layouts.slider');
    }

    public function mount($id)
    {
        $this->module = ModuleItem::find($id);
    }

    public function selectAnswer($answerId)
    {
        $answer = Answer::find($answerId);
        
        $this->selected_answer = $answerId;
        $this->is_correct = $answer->is_correct;
    }
}
