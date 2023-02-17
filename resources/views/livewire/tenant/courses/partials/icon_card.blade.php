<div class="flex justify-start col-span-2">
    @if($card->type->value == \App\Enums\ModuleItemType::Content)
        @if($card->layout == \App\Enums\ContentLayout::LeftImageRightText)
        <div class="p-2 border rounded-md bg-emerald-50">
            <div class="flex">
                <x-heroicon-s-photograph class="w-7 h-7" />
                <x-heroicon-s-menu-alt-2 class="w-7 h-7" />
            </div>
        </div>
        @elseif($card->layout == \App\Enums\ContentLayout::LeftTextRightImage)
        <div class="p-2 border rounded-md bg-emerald-50">
            <div class="flex">
                <x-heroicon-s-menu-alt-2 class="w-7 h-7" />
                <x-heroicon-s-photograph class="w-7 h-7" />
            </div>
        </div>
        @elseif($card->layout == \App\Enums\ContentLayout::TextOnly)
        <div class="p-2 border rounded-md bg-emerald-50">
            <div class="flex">
                <x-heroicon-s-menu-alt-2 class="w-7 h-7" />
            </div>
        </div>
        @elseif($card->layout == \App\Enums\ContentLayout::ImageOnly)
        <div class="p-2 border rounded-md bg-emerald-50">
            <div class="flex">
                <x-heroicon-s-photograph class="w-7 h-7" />
            </div>
        </div>
        @endif
    @elseif($card->type->value == \App\Enums\ModuleItemType::Document)
    <div class="p-2 border rounded-md bg-emerald-50">
        <div class="flex">
            <x-heroicon-s-document-text class="w-7 h-7" />
        </div>
    </div>
    @elseif($card->type->value == \App\Enums\ModuleItemType::Video)
    <div class="p-2 border rounded-md bg-emerald-50">
        <div class="flex">
            <x-heroicon-s-video-camera class="w-7 h-7" />
        </div>
    </div>
@elseif($card->type->value == \App\Enums\ModuleItemType::Question)
    <div class="p-2 border rounded-md bg-emerald-50">
        <div class="flex">
            <x-heroicon-s-question-mark-circle class="w-7 h-7" />
        </div>
    </div>
    @endif
</div>