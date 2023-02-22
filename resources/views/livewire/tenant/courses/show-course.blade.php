<div>
    <div class="px-8 py-12 bg-gray-100">
        <section class="max-w-3xl mt-8">
            <div class="grid grid-cols-3 gap-6 p-8 bg-white border shadow-lg">
                <div class="col-span-2 pr-4 border-r rounded-md ">
                    <div class="inline-block p-4 bg-gray-100 rounded-md">
                        <x-heroicon-s-academic-cap class="w-10 h-10 text-gray-600"/>
                    </div>
    
                    <h1 class="mt-8 text-3xl font-bold text-emerald-800">{{ $course->title }}</h1>
                    <div class="mt-4">{!! $course->description !!}</div>
                    <div class="flex gap-3 mt-8">
                        <div class="flex items-center gap-1">
                            <x-heroicon-o-template class="w-4 h-4 text-gray-400"/>
                            <span class="text-sm">{{ $course->modules()->count() }} modules</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <x-heroicon-o-clock class="w-4 h-4 text-gray-400"/>
                            <span class="text-sm">{{ Carbon\Carbon::parse($course->estimated_time)->format('H:i') }} minutes</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-center self-center justify-center">
                    <button type="button" wire:click="start" class="duration-300 ease-in-out scale-90 hover:scale-100">
                        <x-heroicon-s-play class="w-32 h-32 text-emerald-800"/>
                    </button>
                    @if($is_enrolled)
                    <p class="mt-4">Continue</p>
                    @else
                    <p class="mt-4">Start learning</p>
                    @endif
                </div>
            </div>

            <div class="relative mt-12">
                <div class="absolute top-0 bottom-0 translate-x-1/2 border-r-2 border-gray-300 left-1/2"></div>
                <div class="space-y-6">
                    @foreach($course->modules()->ordered()->get() as $module)
                    <div wire:key="module-{{ $module->id }}"
                        class="relative z-20 p-4 bg-white border rounded-md shadow-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1">
                                <div class="p-2 bg-gray-100 rounded-md">
                                    <x-heroicon-o-template class="w-10 h-10 text-gray-400"/>
                                </div>
                                <p class="ml-4 font-bold">{{ $module->title }}</p>
                            </div>
                            <div class="flex items-center gap-2 pr-4">
                                <span>0/{{ $module->items()->count() }}</span>
                                <x-heroicon-s-check-circle class="w-5 h-5 text-blue-700"/>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
