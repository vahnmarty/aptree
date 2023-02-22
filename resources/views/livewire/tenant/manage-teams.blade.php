@section('header')
    <header class="flex justify-between px-8 py-6">
        <h1 class="text-4xl font-bold leading-7 text-emerald-900 sm:leading-9">Teams</h1>
        <div>
            <button x-data x-on:click="$wire.emit('createTeam')" type="button" class="btn-primary">
                <x-heroicon-o-plus class="w-4 h-4 mr-3 "/>
                <span>Create Team</span>
            </button>
        </div>
    </header>
@endsection

<div>
    
    <x-modal>
        <x-slot name="title">Team Editor</x-slot>
        <div>
            <form  wire:submit.prevent="submit">
                {{ $this->form}}

                <div class="mt-8">
                    <button type="submit" class="btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </x-modal>
    
    <div class="px-8 py-12 bg-gray-100">
        <section>

            <div class="pb-6 border-b-2 border-gray-300">
                <h3 class="text-xl font-bold text-emerald-800">My Teams</h3>
                <p class="mt-2">The teams that you are member of.</p>
            </div>

            <div class="grid grid-cols-3 gap-6 mt-8">

                @foreach(range(1, 2) as $range)
                <div class="p-6 bg-white border rounded-md">
                    <div>
                        <x-heroicon-s-user-group class="w-10 h-10 text-gray-400"/>
                    </div>
                    <h3 class="mt-2 text-lg font-bold text-emerald-800">Team {{ $range }}</h3>
                    <div class="flex justify-between mt-8">
                        <div class="flex gap-3">
                            <div class="flex items-center gap-1">
                                <x-heroicon-s-user-circle class="w-6 h-6 text-gray-400"/>
                                <span class="text-sm">6 Members</span>
                            </div>
                        </div>
                        <div>
                            <x-dropdown>
                                <x-slot name="button">
                                    <button>
                                        <x-heroicon-s-dots-vertical class="w-4 h-4 text-gray-400"/>
                                    </button>
                                </x-slot>
                                <div>
                                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 group" role="menuitem"
                                        tabindex="-1" id="menu-item-0">
                                        <x-heroicon-s-eye  class="w-5 h-5 mr-3 text-gray-400 group-hover:text-gray-500"/>
                                        View
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 group" role="menuitem"
                                        tabindex="-1" id="menu-item-0">
                                        <x-heroicon-s-logout  class="w-5 h-5 mr-3 text-gray-400 group-hover:text-gray-500"/>
                                        Leave
                                    </a>
                                </div>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </section>

    </div>
</div>
