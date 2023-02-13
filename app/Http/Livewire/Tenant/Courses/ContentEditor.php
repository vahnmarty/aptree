<?php

namespace App\Http\Livewire\Tenant\Courses;

use Closure;
use App\Models\Module;
use Livewire\Component;
use App\Enums\ContentLayout;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class ContentEditor extends Component implements HasForms
{
    use InteractsWithForms;

    public $type, $layout, $title, $image, $content;

    protected $listeners = ['setContentType' => 'setType'];
    
    public function render()
    {
        return view('livewire.tenant.courses.content-editor');
    }

    public function mount($module_id)
    {
        $this->setModule($module_id);
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(2)
                ->reactive()
                ->schema([
                    TextInput::make('title')->required(),
                    Select::make('layout')
                        ->required()
                        ->reactive()
                        ->options(ContentLayout::asSelectArray())
                        ->afterStateUpdated(function (Closure $set, Closure $get, $state) {
                            $this->getContentForm();
                        }),
                ]),
            $this->getContentForm()
        ];
    }

    public function getContentForm()
    {
        if($this->layout == ContentLayout::LeftImageRightText)
        {
            return Fieldset::make('content')
                ->label('Image & Text')
                ->schema([
                    FileUpload::make('image')->image()->required(),
                    Textarea::make('content')->placeholder('Enter description here')->required(),
                ]);
        }

        if($this->layout == ContentLayout::LeftTextRightImage)
        {
            return Fieldset::make('content')
                ->label('Text & Image')
                ->schema([
                    Textarea::make('content')->placeholder('Enter description here')->required(),
                    FileUpload::make('image')->image()->required(),
                ]);
        }

        if($this->layout == ContentLayout::TextOnly)
        {
            return Fieldset::make('content')
                ->label('Text Only')
                ->schema([
                    Textarea::make('content')->placeholder('Enter description here')->columnSpan('full')->required(),
                ]);
        }

        if($this->layout == ContentLayout::ImageOnly)
        {
            return Fieldset::make('content')
                ->label('Image Only')
                ->schema([
                    $this->getFieldFileUpload()->required()
                ]);
        }

        return Fieldset::make('default');
    }

    public function getFieldFileUpload()
    {
        return FileUpload::make('image')->columnSpan('full')
                ->extraAttributes(['class' => 'bg-gray-100'])
                ->imagePreviewHeight('100')
                ->loadingIndicatorPosition('left')
                ->panelAspectRatio('4:1')
                ->panelLayout('integrated')
                ->removeUploadedFileButtonPosition('right')
                ->uploadButtonPosition('left')
                ->uploadProgressIndicatorPosition('left');
    }

    public function setModule($id)
    {
        $this->module = Module::find($id);
    }

    public function setType($type)
    {
        $this->reset('layout');

        $this->type = $type;

        switch ($type) {
            case 'image-text':
                $this->layout = ContentLayout::LeftImageRightText;
                break;

            case 'text-image':
                $this->layout = ContentLayout::LeftTextRightImage;
                break;

            case 'text':
                $this->layout = ContentLayout::TextOnly;
                break;

            case 'image':
                $this->layout = ContentLayout::ImageOnly;
                break;
            
            default:
                break;
        }

        $this->getContentForm();
        
    }

    public function save()
    {
        $data = $this->validate();
    }
}
