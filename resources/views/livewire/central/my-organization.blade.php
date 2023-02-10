@section('header')
    <header class="flex justify-between px-8 py-6">
        <h1 class="text-4xl font-bold leading-7 text-emerald-900 sm:leading-9">Organizations</h1>
        <div>
            <button x-data x-on:click="$dispatch('openmodal-create')" type="button" class="btn-primary">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                </svg>

                Create Organization
            </button>
        </div>
    </header>
@endsection

@section('content')
    <x-modal ref="create">
        <x-slot name="title">{{ __('Create Organization') }}</x-slot>
        <div class="py-6">
            @livewire('central.create-organization')
        </div>
    </x-modal>
    <div class="px-8 py-12 bg-gray-100">
        <section>
            <div class="pb-6">
                @if ($tenants->count())
                    <div class="grid grid-cols-1 gap-5 mt-10 sm:grid-cols-2 lg:grid-cols-2">

                        @foreach ($tenants as $tenant)
                            <div class="p-8 bg-white rounded-lg shadow">

                                <div class="flex flex-row items-center mb-4">
                                    <span class="inline-flex items-start space-x-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6 text-gray-500">
                                            <path
                                                d="M15.75 8.25a.75.75 0 01.75.75c0 1.12-.492 2.126-1.27 2.812a.75.75 0 11-.992-1.124A2.243 2.243 0 0015 9a.75.75 0 01.75-.75z" />
                                            <path fill-rule="evenodd"
                                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM4.575 15.6a8.25 8.25 0 009.348 4.425 1.966 1.966 0 00-1.84-1.275.983.983 0 01-.97-.822l-.073-.437c-.094-.565.25-1.11.8-1.267l.99-.282c.427-.123.783-.418.982-.816l.036-.073a1.453 1.453 0 012.328-.377L16.5 15h.628a2.25 2.25 0 011.983 1.186 8.25 8.25 0 00-6.345-12.4c.044.262.18.503.389.676l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 01-1.161.886l-.143.048a1.107 1.107 0 00-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 01-1.652.928l-.679-.906a1.125 1.125 0 00-1.906.172L4.575 15.6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>


                                </div>

                                <div class="space-y-0.5">
                                    <span class="text-base font-medium text-red-600">
                                        {{ $tenant->plan->name }}
                                    </span>
                                    <h3 class="text-lg font-medium text-aptree-600">
                                        <a href="https://aptree.dev/dashboard/teams/manchester-united">
                                            {{ $tenant->name }}
                                        </a>
                                    </h3>
                                    @foreach ($tenant->domains as $domain)
                                        <a href="{{ $domain->getUrl() }}" target="_blank"
                                            class="text-sm font-normal text-gray-500 hover:text-emerald-500">
                                            {{ $domain->getUrl() }}
                                        </a>
                                    @endforeach
                                </div>

                                <div class="flex items-center justify-between mt-6 space-x-4 align-middle">
                                    <span class="inline-flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z">
                                            </path>
                                        </svg>

                                        <span class="text-sm font-medium text-gray-600">{{ $tenant->users()->count() }}
                                            Members</span>
                                    </span>

                                    <span x-data="{ showDropdown: false }" class="relative z-10 flex justify-end ml-auto">
                                        <button type="button" x-on:click="showDropdown = !showDropdown"
                                            x-on:click.away="showDropdown = false">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="w-6 h-6 text-gray-500">
                                                <path fill-rule="evenodd"
                                                    d="M10.5 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>

                                        <div x-show="showDropdown"
                                            class="absolute right-0 z-20 w-48 py-1 mt-2 overflow-y-auto origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                            tabindex="-1" style="display: none;">
                                            <div class="flex flex-col">
                                                <a href="{{ $tenant->getUrl() }}"
                                                    class="inline-flex px-4 py-2 text-sm text-gray-700 hover:text-indigo-600"
                                                    role="menuitem" tabindex="-1" id="user-menu-item-0">
                                                    <svg class="w-5 h-5 mr-2 text-gray-500"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z"></path>
                                                        <path fill-rule="evenodd"
                                                            d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>

                                                    View
                                                </a>

                                                <button x-on:click="$wire.emitTo('global.team.remove', 'deleteTeam', 4)"
                                                    type="button"
                                                    class="inline-flex px-4 py-2 text-sm text-gray-700 hover:text-indigo-600"
                                                    role="menuitem" tabindex="-1" id="user-menu-item-0">
                                                    <svg class="w-5 h-5 mr-2 text-gray-500"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>

                                                    Request for Delete
                                                </button>
                                            </div>

                                        </div>
                                    </span>
                                </div>

                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-6 text-center bg-gray-200 border border-gray-300 border-dashed">
                        <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No organizations</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new organization.</p>
                        <div class="mt-6">
                            <button type="button" x-data x-on:click="$dispatch('openmodal-create')" class="btn-primary">
                                <!-- Heroicon name: mini/plus -->
                                <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                </svg>
                                New Organization
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </section>

    </div>
@endsection
