@section('header')
    <header class="flex justify-between px-8 py-6">
        <h1 class="text-3xl font-bold leading-7 text-emerald-900 sm:leading-9">Add New Course</h1>
    </header>
@endsection

<div>

    <x-modal ref="module-create">
        <x-slot name="title">
            Create Module
        </x-slot>
        <div class="pt-4">
            @livewire('tenant.courses.create-module', ['id' => $course->id])
        </div>
    </x-modal>

    <div class="px-8 py-12 bg-gray-100 text-emerald-900">
        <nav class="flex items-center space-x-4" aria-label="Tabs">

            <div>
                <span class="rounded-sm bg-gray-300 px-1.5 py-0.5 text-sm font-bold text-emerald-900">1</span>
                <span class="ml-2 font-bold text-gray-500">Overview</span>
            </div>
            <div>
                <span class="rounded-sm bg-emerald-900 px-1.5 py-0.5 text-sm font-bold text-white">2</span>
                <span class="ml-2 font-bold text-emerald-900">Content</span>
            </div>
        </nav>
        <section class="mt-8">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-2">
                    <div class="bg-white rounded-md">
                        <header class="flex justify-between px-4 py-4">
                            <h3 class="font-bold">Modules</h3>
                            <div>
                                <button x-data x-on:click="$dispatch('openmodal-module-create')" type="button"
                                    class="p-1 text-sm rounded-md bg-emerald-600 hover:bg-emerald-800">
                                    <x-heroicon-s-plus class="w-4 h-4 text-white" />
                                </button>
                            </div>
                        </header>
                        <div x-data="{ module_id: @entangle('module_id') }" class="px-4 py-4 space-y-2">
                            @forelse($course->modules as $module)
                                <div wire:click="selectModule({{ $module->id }})"
                                    :class="module_id == {{ $module->id }} ? 'border-2 border-orange-400' : ''"
                                    class="px-2 py-2 border rounded-md cursor-pointer hover:bg-gray-50">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <x-heroicon-o-menu class="w-6 h-6 mr-2 text-gray-900" />
                                            <p>{{ $module->title }}</p>
                                        </div>
                                        <div>
                                            <button type="button">
                                                <x-heroicon-o-trash class="w-6 h-6 text-gray-500 text-gray-900" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="bg-gray-100">
                                    <button x-data x-on:click="$dispatch('openmodal-module-create')" type="button"
                                        class="relative block w-full p-12 text-center border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        <svg class="w-12 h-12 mx-auto text-gray-400" stroke="currentColor"
                                            fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 14v20c0 4.418 7.163 8 16 8 1.381 0 2.721-.087 4-.252M8 14c0 4.418 7.163 8 16 8s16-3.582 16-8M8 14c0-4.418 7.163-8 16-8s16 3.582 16 8m0 0v14m0-4c0 4.418-7.163 8-16 8S8 28.418 8 24m32 10v6m0 0v6m0-6h6m-6 0h-6" />
                                        </svg>
                                        <span class="block mt-2 text-sm font-medium text-gray-900">Add New Module</span>
                                    </button>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-span-4">
                    @if ($module_id)
                        <div class="min-h-[16rem] rounded-md border bg-white">
                            <header class="p-4">
                                <h2 class="font-bold text-emerald-900">{{ $selected_module->title }}</h2>
                            </header>
                            <div class="p-4">
                                <div class="p-4 border-2 rounded-md border-emerald-700">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <x-heroicon-s-plus class="w-5 h-5" />
                                            <p class="text-sm">Add a New Card</p>
                                        </div>
                                        <div class="flex gap-1">
                                            <x-dropup>
                                                <x-slot name="button">
                                                    <button @click="open = !open"
                                                        class="w-10 h-10 px-2 py-2 bg-gray-200 rounded-md hover:bg-gray-300">
                                                        <span class="font-bold group text-emerald-700">A</span>
                                                    </button>
                                                </x-slot>
                                                <div class="relative px-3 py-3 bg-gray-300 rounded-md shadow-xs">
                                                    <div class="flex flex-col space-y-1">

                                                        <button type="button"
                                                            class="p-2 bg-white border rounded-md hover:bg-emerald-50">
                                                            <div class="flex">
                                                                <x-heroicon-s-photograph class="w-4 h-4" />
                                                                <x-heroicon-s-menu-alt-2 class="w-4 h-4" />
                                                            </div>
                                                        </button>
                                                        <button type="button"
                                                            class="p-2 bg-white border rounded-md hover:bg-emerald-50">
                                                            <div class="flex">
                                                                <x-heroicon-s-menu-alt-2 class="w-4 h-4" />
                                                                <x-heroicon-s-photograph class="w-4 h-4" />
                                                            </div>
                                                        </button>
                                                        <button type="button"
                                                            class="flex justify-center p-2 text-center bg-white border rounded-md hover:bg-emerald-50">
                                                            <div class="flex">
                                                                <x-heroicon-s-menu-alt-2 class="w-4 h-4" />
                                                            </div>
                                                        </button>
                                                        <button type="button"
                                                            class="flex justify-center p-2 text-center bg-white border rounded-md hover:bg-emerald-50">
                                                            <div class="flex">
                                                                <x-heroicon-s-photograph class="w-4 h-4" />
                                                            </div>
                                                        </button>
                                                    </div>
                                                </div>
                                            </x-dropup>

                                            <x-dropup>
                                                <x-slot name="button">
                                                    <button @click="open = !open"
                                                        class="w-10 h-10 px-2 py-2 bg-gray-200 rounded-md text-emerald-700 hover:bg-gray-300">
                                                        <x-heroicon-s-video-camera />
                                                    </button>
                                                </x-slot>
                                                <div class="relative w-32 px-3 py-3 bg-gray-300 rounded-md shadow-xs">
                                                    <div class="flex flex-col space-y-1">
                                                        <button type="button"
                                                            class="p-2 text-sm bg-white border rounded-md hover:bg-emerald-50">
                                                            <span>Add Video</span>
                                                        </button>
                                                        <button type="button"
                                                            class="p-2 text-sm bg-white border rounded-md hover:bg-emerald-50">
                                                            <span>Record a Video</span>
                                                        </button>
                                                    </div>
                                                </div>

                                            </x-dropup>

                                            <x-dropup>
                                                <x-slot name="button">
                                                    <button @click="open = !open"
                                                        class="w-10 h-10 px-2 py-2 bg-gray-200 rounded-md text-emerald-700 hover:bg-gray-300">
                                                        <x-heroicon-o-document-text />
                                                    </button>
                                                </x-slot>
                                                <div class="relative w-32 px-3 py-3 bg-gray-300 rounded-md shadow-xs">
                                                    <div class="flex flex-col space-y-1">
                                                        <button type="button"
                                                            class="p-2 text-sm bg-white border rounded-md hover:bg-emerald-50">
                                                            <span>Upload</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </x-dropup>

                                            <x-dropup>
                                                <x-slot name="button">
                                                    <button @click="open = !open"
                                                        class="w-10 h-10 px-2 py-2 bg-gray-200 rounded-md text-emerald-700 hover:bg-gray-300">
                                                        <x-heroicon-s-question-mark-circle />
                                                    </button>
                                                </x-slot>
                                                <div class="relative w-32 px-3 py-3 bg-gray-300 rounded-md shadow-xs">
                                                    <div class="flex flex-col space-y-1">
                                                        <button type="button"
                                                            class="p-2 text-xs bg-white border rounded-md hover:bg-emerald-50">
                                                            <span>Multiple Choice</span>
                                                        </button>
                                                        <button type="button"
                                                            class="p-2 text-xs bg-white border rounded-md hover:bg-emerald-50">
                                                            <span>AI Question Generator</span>
                                                        </button>
                                                        <button type="button"
                                                            class="p-2 text-xs bg-white border rounded-md hover:bg-emerald-50">
                                                            <span>True / False</span>
                                                        </button>
                                                        <button type="button"
                                                            class="p-2 text-xs bg-white border rounded-md hover:bg-emerald-50">
                                                            <span>Likert Scale</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </x-dropup>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-gray-100">
                            <button type="button"
                                class="relative block w-full p-12 text-center border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <svg class="w-12 h-12 mx-auto text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 14v20c0 4.418 7.163 8 16 8 1.381 0 2.721-.087 4-.252M8 14c0 4.418 7.163 8 16 8s16-3.582 16-8M8 14c0-4.418 7.163-8 16-8s16 3.582 16 8m0 0v14m0-4c0 4.418-7.163 8-16 8S8 28.418 8 24m32 10v6m0 0v6m0-6h6m-6 0h-6" />
                                </svg>
                                <span class="block mt-2 text-sm font-medium text-gray-900">Select Module First</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
</div>
