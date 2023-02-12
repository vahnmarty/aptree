<?php

namespace App\Http\Livewire\Tenant\Courses;

use App\Models\User;
use Livewire\Component;
use Filament\Forms\Components\Grid;
use App\Forms\Components\SelectIcon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use App\Forms\Components\SimpleFieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class CreateCourse extends Component implements HasForms
{
    use InteractsWithForms;

    public $title, $icon = 'education', $passing_score = 70;
    public $category, $estimated_time_complete, $instructors = [], $description, $tags = [];
    public $is_required_passing_modules;
    public $attachment;
    
    public function render()
    {
        return view('livewire.tenant.courses.create-course');
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(5)
                ->schema([
                    SimpleFieldset::make('Form')
                        ->schema([
                            Grid::make(5)
                            ->schema([
                            TextInput::make('title')
                                ->label('Course Title')
                                ->placeholder('Enter your course title')
                                ->columnSpan(4),
                            SelectIcon::make('icon')
                                ->columnSpan(1),
                            Select::make('category')
                                ->options([])->columnSpan(3),
                            TimePicker::make('estimated_time_complete')
                                ->placeholder('HH::mm')->withoutSeconds()->columnSpan(2),
                            Select::make('instructor')
                                ->multiple()
                                ->searchable()
                                ->preload()
                                ->options(User::get()->pluck('name', 'id'))
                                ->columnSpan('full'),
                            Textarea::make('description')
                                ->placeholder('Enter description')
                                ->columnSpan('full'),
                            Select::make('tags')
                                ->label('Keywords')
                                ->multiple()
                                ->searchable()
                                ->preload()
                                ->options([])
                                ->columnSpan('full'),
                            Select::make('passing_score')
                                ->label('Set passing score')
                                ->preload()
                                ->reactive()
                                ->options(function(){
                                    return $this->getScorePercentages();
                                })
                                ->default(10),
                            Toggle::make('is_required_passing_modules')->label('Require Passing all Modules?')->inline()->columnSpan(3)
                            ]),
                        ])->columnSpan(3),
                    SimpleFieldset::make('Media')
                        ->columnSpan(2)
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('avatar')
                            ->label('Upload course image')
                            ->columnSpan('full')
                        ]),
                ]),
        ];
    }

    private function getScorePercentages() : array 
    {
        $array = [];

        foreach([0, 50, 60, 70, 80, 90, 100] as $val => $pct)
        {
            $array[$pct] = $pct . '%';
        }

        return $array;
    }

    public function submit()
    {

    }
}
