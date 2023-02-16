<?php

namespace App\Http\Livewire\Tenant\Courses;

use SplFileObject;
use App\Models\Module;
use GuzzleHttp\Client;
use Livewire\Component;
use App\Enums\ModuleItemType;
use Livewire\WithFileUploads;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use ApiVideo\Client\Client as ApiClient;
use Filament\Forms\Components\TextInput;
use Symfony\Component\HttpClient\Psr18Client;
use ApiVideo\Client\Model\VideoCreationPayload;
use Filament\Forms\Concerns\InteractsWithForms;

class VideoEditor extends Component  implements HasForms
{
    use InteractsWithForms;

    public $action;

    public $module_id;

    public $title, $description, $video;

    public $api_video, $ready_for_upload = false;

    public function render()
    {
        return view('livewire.tenant.courses.video-editor');
    }

    public function mount($moduleId)
    {
        $this->module_id = $moduleId;
    }

    public function saveApiVideo($data)
    {
        if($data){
            $this->api_video = $data;
            $this->ready_for_upload = true;
        }
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('title')->required(),
            Textarea::make('description')->required()
        ];
    }

    public function submit()
    {
        $data = $this->form->getState();

        $module = Module::find($this->module_id);
        $api_video = $this->api_video;
        $module->items()->create([
            'type' => ModuleItemType::Video,
            'title' => $data['title'],
            'content' => $data['description'],
            'video_response' => $api_video,
            'video_id' => $api_video['videoId'],
            'video_format' => $api_video['mp4Support'] ? 'mp4' : '',
            'video_embed_url' => $api_video['assets']['player'] ?? '',
            'video_source' => 'apivideo',
            'video_player' => $api_video['assets']['player'] ?? '',
            'video_thumbnail' => $api_video['assets']['thumbnail'] ?? '',
        ]);

        return redirect(request()->header('Referer'));
    }

    public function fromSdk()
    {
        $httpClient = new Psr18Client();
        $apiKey = config('services.apivideo.key');
        $url = 'https://sandbox.api.video';
        $client = new ApiClient(
            $url,
            $apiKey,
            $httpClient
        );

        $file = request()->file('video');
        $fileName = request()->title;
        $payload = (new VideoCreationPayload())->setTitle($fileName);
        $payload = $payload->setTitle('Hello');
        if (isset(request()->description))
        {
            $payload->setDescription(request()->description);
        }
        if(isset(request()->public))
        {
            $payload->setPublic(False);
        }
        if(isset(request()->mp4support))
        {
            $payload->setMp4support(False);
        }
        $video = $client->videos()->create($payload);
        $filePath = request()->file('video')->getRealPath();

        $response = $client->videos()->upload(
            $video->getVideoId(),
            new SplFileObject($filePath)
        );

        return redirect('/response');
    }
}
