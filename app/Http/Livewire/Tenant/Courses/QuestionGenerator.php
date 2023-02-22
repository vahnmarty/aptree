<?php

namespace App\Http\Livewire\Tenant\Courses;

use Livewire\Component;
use App\Services\AiQuestion;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;

class QuestionGenerator extends Component implements HasForms
{
    use InteractsWithForms;
    
    protected $listeners = [ 'createAiQuestion' => 'create' ];

    public $content;

    public function render()
    {
        return view('livewire.tenant.courses.question-generator');
    }

    public function create()
    {
        $this->dispatchBrowserEvent('openmodal-ai');
    }

    protected function getFormSchema() : array
    {
        return [
            Textarea::make('content')
                ->required()
                ->placeholder('Write your article here')
                ->rows(8)
        ];
    }

    public function generate()
    {
        $data = $this->form->getState();

        return $this->generateAiQuestion($data['content']);
    }

    public function generateAiQuestion($contents)
    {
        $ai = new AiQuestion;
        $output = $ai->generate();

        dd($output);
    }
}
