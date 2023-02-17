<?php

namespace App\Http\Livewire\Tenant\Courses;

use Closure;
use App\Models\Module;
use Livewire\Component;
use App\Enums\ActionType;
use App\Enums\QuestionType;
use App\Enums\ModuleItemType;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Contracts\HasForms;
use App\Forms\Components\DynamicOption;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use App\Forms\Components\SimpleFieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Concerns\InteractsWithForms;

class QuestionEditor extends Component implements HasForms
{
    use InteractsWithForms;

    public $action;

    public $title, $type, $answers = [], $description, $explanation, $display_explanation;

    protected $listeners = [ 'createQuestion' => 'create' ];
    
    public function render()
    {
        return view('livewire.tenant.courses.question-editor');
    }

    public function mount($moduleId)
    {
        $this->module_id = $moduleId;
        $this->answers = $this->getDefaultAnswers();
    }

    public function create($type)
    {
        $this->action = ActionType::Create;
        $this->type = $type;
        $this->dispatchBrowserEvent('openmodal-question');
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(2)
                ->schema([
                SimpleFieldset::make('question')
                    ->schema([
                        TextInput::make('title')->label('Question')->placeholder('Enter your question here.')->required(),
                        Textarea::make('description')->rows(3)->placeholder('Description (Optional)'),
                        Textarea::make('explanation')->rows(3)->placeholder('Explanation Text')->required(),
                        Toggle::make('display_explanation')->label('Display Explanation?')->inline()
                    ])
                    ->columnSpan(1),
                Fieldset::make('answers')
                    ->label('Create your Answers')
                    ->schema([
                        DynamicOption::make('answers')
                        ->keyLabel('Option')
                        ->valueLabel('Is Correct')
                        ->columnSpan('full')
                        ->addButtonLabel('Add Answer')
                        ->rules([
                            function () {
                                return function ($attribute, $value, Closure $fail) {
                                    $options = $value;
                                    $selected = 0;

                                    foreach($options as $left => $option){
                                        if($option == true){
                                            $selected++;
                                            break;
                                        }
                                    }

                                    if ($selected <= 0) {
                                        $fail("The {$attribute} is invalid. Please mark a correct answer.");
                                    }
                                };
                            },
                        ])
                    ])->columnSpan(1)
            ])
        ];
    }

    public function getDefaultAnswers()
    {
        return [ 'Correct Answer 1' => true, 'Wrong Answer 1' => false, 'Wrong Answer 2' => false];
    }

    public function submit()
    {
        $this->validate();

        $data = $this->form->getState();

        $module = Module::find($this->module_id);

        $module_question = $module->items()->create([
            'type' => ModuleItemType::Question,
            'title' => $data['title'],
        ]);

        $question = $module_question->question()->create([
            'title' => $data['title'],
            'type' => QuestionType::MultipleChoice,
            'description' => $data['description'],
            'explanation' => $data['explanation'],
            'display_explanation' => $data['display_explanation'],
        ]);

        foreach($this->answers as $answerText => $answerValue)
        {
            $question->answers()->create([
                'answer' => $answerText,
                'is_correct' => $answerValue ? true : false
            ]);
        }

        return redirect(request()->header('Referer'));
        
    }
    
}
