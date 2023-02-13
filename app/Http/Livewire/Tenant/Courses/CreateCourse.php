<?php

namespace App\Http\Livewire\Tenant\Courses;

use Str;
use App\Models\Tag;
use App\Models\User;
use App\Models\Course;
use App\Models\Tenant;
use Livewire\Component;
use App\Enums\CourseStatus;
use App\Models\CourseCategory;
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

    public $course;

    public $title, $icon = 'education', $passing_score = 70;
    public $category, $estimated_time, $instructors = [], $description, $tags = [];
    public $required_passing_modules;
    public $image;
    
    public function render()
    {
        return view('livewire.tenant.courses.create-course');
    }

    public function mount()
    {
        
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
                                ->columnSpan(4)
                                ->required(),
                            SelectIcon::make('icon')
                                ->required()
                                ->columnSpan(1),
                            Select::make('category')
                                ->options(function(){
                                    return tenancy()->central(function ($tenant) {
                                        return CourseCategory::get()->pluck('name', 'id');
                                    });
                                })
                                ->required()
                                ->preload()
                                ->searchable()
                                ->columnSpan(3),
                            TimePicker::make('estimated_time')
                                ->placeholder('HH::mm')->withoutSeconds()->columnSpan(2),
                            Select::make('instructors')
                                ->multiple()
                                ->searchable()
                                ->preload()
                                ->options(User::get()->pluck('name', 'id'))
                                ->columnSpan('full'),
                            Textarea::make('description')
                                ->placeholder('Enter description')
                                ->required()
                                ->columnSpan('full'),
                            Select::make('tags')
                                ->label('Keywords')
                                ->multiple()
                                ->searchable()
                                ->preload()
                                ->options(function(){
                                    return tenancy()->central(function ($tenant) {
                                        return Tag::get()->pluck('name', 'id');
                                    });
                                })
                                ->columnSpan('full'),
                            Select::make('passing_score')
                                ->label('Set passing score')
                                ->preload()
                                ->reactive()
                                ->options(function(){
                                    return $this->getScorePercentages();
                                })
                                ->required()
                                ->default(10),
                            Toggle::make('required_passing_modules')->label('Require Passing all Modules?')->inline()->columnSpan(3)
                            ]),
                        ])->columnSpan(3),
                    SimpleFieldset::make('Media')
                        ->columnSpan(2)
                        ->schema([
                            FileUpload::make('image')
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

        $data = $this->validate();


        $course = new Course;
        $course->title = $data['title'];
        $course->slug = Str::slug($data['title']);
        $course->icon = $data['icon'];
        $course->description = $data['description'];
        $course->estimated_time = $data['estimated_time'];
        $course->required_passing_modules = $data['required_passing_modules'];
        $course->passing_score = $data['passing_score'];
        $course->status = CourseStatus::Draft;
        $course->save();

        //$this->emit('toast', ['type' => 'success', 'message' => 'Course created successfully!']);

        return redirect()->route('courses.contents', ['id' => $course->id]);

    }
}
