<header x-data="{ mobileMenuOpen: false }" class="relative z-30 bg-white">
    <div class="px-8">
        <div class="flex items-center justify-between h-24 border-gray-100 md:justify-start md:space-x-6">
            <div class="inline-flex">
                <form class="flex w-full md:ml-0" action="#" method="GET">
                    <label for="search-field" class="sr-only">Search</label>
                    <div class="relative w-full pl-4 text-gray-400 border focus-within:text-gray-600">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none" aria-hidden="true">
                        <!-- Heroicon name: mini/magnifying-glass -->
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                        </svg>
                      </div>
                      <input id="search-field" name="search-field" class="block w-full h-full py-4 pl-8 pr-3 text-gray-900 placeholder-gray-500 border-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm" placeholder="Search" type="search">
                    </div>
                  </form>
            </div>
            <div class="flex justify-end flex-grow -my-2 -mr-2 md:hidden">
                <button @click="mobileMenuOpen = true" type="button" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
                </button>
            </div>

            <!-- This is the homepage nav when a user is not logged in -->
            @if(auth()->guest())
                @include('theme::menus.guest')
            @else <!-- Otherwise we want to show the menu for the logged in user -->
                @include('theme::menus.authenticated')
            @endif

        </div>
    </div>

    @if(auth()->guest())
        @include('theme::menus.guest-mobile')
    @else
        @include('theme::menus.authenticated-mobile')
    @endif
</header>
