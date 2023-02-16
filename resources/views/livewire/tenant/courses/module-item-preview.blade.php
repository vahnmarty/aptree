@push('head-scripts')
<script src="https://unpkg.com/@api.video/player-sdk" defer></script>
@endpush

<div class="min-h-screen py-4 bg-gray-200 h-100">
    <div class="px-8 mx-auto max-w-7xl">
        <div class="p-2 text-white bg-red-500 border rounded-md">
            <h4 class="text-center">Preview Mode</h4>
        </div>

        <div class="mt-8">
            @if($module->type->value == \App\Enums\ModuleItemType::Content)
            <section class="max-w-4xl px-4 mx-auto">
                @if($module->layout == \App\Enums\ContentLayout::LeftImageRightText)
                <div class="grid items-center grid-cols-2 gap-6">
                    <div>{!! $module->content !!}</div>
                    <div class="p-4 bg-gray-300 rounded-lg shadow-sm border-md">
                        <img src="{{ $module->getImage() }}" class="h-auto w-96" alt="">
                    </div>
                </div>
                @elseif($module->layout == \App\Enums\ContentLayout::LeftTextRightImage)
                <div class="grid items-center grid-cols-2 gap-6">
                    <div>{!! $module->content !!}</div>
                    <div class="p-4 bg-gray-300 rounded-lg shadow-sm border-md">
                        <img src="{{ $module->getImage() }}" class="h-auto w-96" alt="">
                    </div>
                </div>

                @elseif($module->layout == \App\Enums\ContentLayout::TextOnly)
                <div class="flex justify-center">
                    <div>{!! $module->content !!}</div>
                </div>
                @elseif($module->layout == \App\Enums\ContentLayout::ImageOnly)
                <div class="flex justify-center">
                    <div class="p-4 bg-gray-300 rounded-lg shadow-sm border-md">
                        <img src="{{ $module->getImage() }}" class="h-auto w-96" alt="">
                    </div>
                </div>
                @endif
            </section>
            @elseif($module->type->value == \App\Enums\ModuleItemType::Video)
            <section class="max-w-4xl px-4 mx-auto">
                <div class="flex justify-center">
                    <iframe src="{{ $module->video_embed_url }}" height="400" width="700" title="Video Preview" allow="fullscreen"></iframe>
                </div>
                <div class="flex flex-col items-center justify-center mt-4">
                    <h2 class="text-lg font-bold">{{ $module->title }}</h2>
                    <div>{!! $module->content !!}</div>
                </div>
            </section>
            @endif
        </div>
    </div>
</div>
