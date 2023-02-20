<div class="min-h-screen py-4 bg-gray-100 h-100">
    <div class="px-8 mx-auto max-w-7xl">
        <section class="flex mt-8 divide-x-2 lg:mt-20 justify-evenly">
            @foreach(range(1, 8) as $progress)
                @if($progress == 1)
                <div class="w-full h-2 bg-orange-400 rounded-l-md "></div>
                @elseif($progress == 8)
                <div class="w-full h-2 bg-orange-400 rounded-r-md "></div>
                @else
                <div class="w-full h-2 bg-orange-400 "></div>
                @endif
            @endforeach
        </section>
        <div class="max-w-sm mx-auto mt-24">
            <section class="flex flex-col items-center justify-center">
                <div>
                    <x-heroicon-s-puzzle class="w-16 h-16 text-gray-300"/>
                </div>
                <p class="mt-4 font-bold text-orange-500">{{ $course->title }}</p>
    
                <h1 class="mt-4 text-3xl font-bold text-emerald-800">{{ $module->title }}</h1>
    
                <p class="px-2 mt-4 text-sm text-center">Remember to do your best with each question. Points are awarded for first time correct answers!</p>

                <div class="w-full p-6 mt-8 bg-white border rounded-md">
                    <div class="grid grid-cols-2 divide-x">
                        <div class="flex items-center justify-end gap-1 pr-4">
                            <x-heroicon-o-template class="w-4 h-4 text-gray-400"/>
                            <span class="text-sm">{{ $module->items()->count() }} Exercises</span>
                        </div>
                        <div class="flex items-center gap-1 pl-4">
                            <x-heroicon-o-clock class="w-4 h-4 text-gray-400"/>
                            <span class="text-sm">3 minutes</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <footer class="fixed bottom-0 left-0 right-0 z-20 py-6 bg-white border-t">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-between">
                <h3 class="font-bold text-emerald-900">Course Overview</h3>
                <div>
                    <button type="button" class="btn-primary">Continue</button>
                </div>
            </div>
        </div>
    </footer>
</div>