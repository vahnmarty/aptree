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
use App\Models\CourseSubcategory;
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
    public $category_id, $subcategories = [], $estimated_time, $instructors = [], $description, $tags = [];
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
                            Select::make('category_id')
                                ->label('General Category')
                                ->options(function(){
                                    return tenancy()->central(function ($tenant) {
                                        return CourseCategory::get()->pluck('name', 'id');
                                    });
                                })
                                ->required()
                                ->preload()
                                ->searchable()
                                ->columnSpan('full'),
                            Select::make('subcategories')
                                ->label('Specific Category')
                                ->multiple()
                                ->options(function(){
                                    return tenancy()->central(function ($tenant) {
                                        return CourseSubcategory::where('course_category_id', $this->category_id)->get()->pluck('name', 'id');
                                    });
                                })
                                ->reactive()
                                ->required()
                                ->preload()
                                ->searchable()
                                ->columnSpan('full'),
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
                            // Select::make('tags')
                            //     ->label('Keywords')
                            //     ->multiple()
                            //     ->searchable()
                            //     ->preload()
                            //     ->options(function(){
                            //         return tenancy()->central(function ($tenant) {
                            //             return Tag::get()->pluck('name', 'id');
                            //         });
                            //     })
                            //     ->columnSpan('full'),

                            TimePicker::make('estimated_time')
                                ->placeholder('HH::mm')->withoutSeconds(),
                            Select::make('passing_score')
                                ->label('Passing score')
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
                            ->image()
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
    
    protected function getFormModel(): string
    {
        return Course::class;
    }

    public function submit()
    {
        $data = $this->form->getState();


        # Create Course
        $course = new Course;
        $course->title = $data['title'];
        $course->icon = $data['icon'];
        $course->description = $data['description'];
        $course->category_id = $data['category_id'];
        $course->estimated_time = $data['estimated_time'];
        $course->required_passing_modules = $data['required_passing_modules'];
        $course->passing_score = $data['passing_score'];
        $course->image = $data['image'];
        $course->status = CourseStatus::Draft;
        $course->slug = Str::slug($data['title']);
        $course->save();
    

        try {
            # Relationships
            $course->subcategories()->attach($data['subcategories']);
            $course->instructors()->attach($data['instructors']);

        } catch (\Throwable $th) {

            throw $th;
        }
        
        return redirect()->route('courses.contents', ['id' => $course->id]);

    }
}
