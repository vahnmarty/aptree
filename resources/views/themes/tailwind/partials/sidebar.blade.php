<div class="w-64 max-h-screen min-h-screen bg-gray-900 border-r bg-gradient-to-b from-gray-800 to-gray-700 dark:from-gray-900 dark:to-gray-800">
    <div class="flex flex-col flex-grow min-h-screen py-5 overflow-y-auto shadow">
        <div class="flex items-center flex-shrink-0 px-4">
            <button x-on:click="$store.sidebarExpanded.toggle()" type="button">
              <img class="flex-shrink-0 w-auto h-8" src="{{ global_asset('img/logo.png') }}" alt="Company name">
            </button>
        </div>

        <nav class="flex flex-col flex-1 mt-5 overflow-y-auto divide-y divide-gray-300" aria-label="Sidebar">
          <div  class="flex-1 px-2 space-y-1">

            <a href="{{ url('dashboard') }}"
                class="{{ request()->routeIs('dashboard.home') ? 'border-l-4 border-orange-400 bg-gray-600 text-white' : 'text-gray-300 hover:bg-gray-700' }} group flex items-center px-2 py-2 text-sm leading-6 font-medium" aria-current="page">
                <svg class="flex-shrink-0 w-6 h-6 ml-1 mr-4 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                    <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                </svg>

                <!-- label here -->
                <span x-show="$store.sidebarExpanded.on">Home</span>
            </a>

            <a href="{{ route('organization') }}"
                class="{{ request()->routeIs('organization*') ? 'border-l-4 border-orange-400 bg-gray-600 text-white' : 'text-gray-300 hover:bg-gray-700' }} group flex items-center px-2 py-2 text-sm leading-6 font-medium">

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0 w-6 h-6 ml-1 mr-4 text-gray-300">
                  <path d="M15.75 8.25a.75.75 0 01.75.75c0 1.12-.492 2.126-1.27 2.812a.75.75 0 11-.992-1.124A2.243 2.243 0 0015 9a.75.75 0 01.75-.75z" />
                  <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM4.575 15.6a8.25 8.25 0 009.348 4.425 1.966 1.966 0 00-1.84-1.275.983.983 0 01-.97-.822l-.073-.437c-.094-.565.25-1.11.8-1.267l.99-.282c.427-.123.783-.418.982-.816l.036-.073a1.453 1.453 0 012.328-.377L16.5 15h.628a2.25 2.25 0 011.983 1.186 8.25 8.25 0 00-6.345-12.4c.044.262.18.503.389.676l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 01-1.161.886l-.143.048a1.107 1.107 0 00-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 01-1.652.928l-.679-.906a1.125 1.125 0 00-1.906.172L4.575 15.6z" clip-rule="evenodd" />
                </svg>
                

                <!-- label here -->
                <span x-show="$store.sidebarExpanded.on">Organization </span>
            </a>
            
            <a href="{{ url('dashboard.administer.billing') }}"
                class="flex items-center px-2 py-2 text-sm font-medium leading-6 text-gray-300 rounded-md group hover:bg-gray-700">
                <svg class="flex-shrink-0 w-6 h-6 ml-1 mr-4 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                    <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z" clip-rule="evenodd" />
                </svg>

                <span x-show="$store.sidebarExpanded.on">Billing </span>
              </a>

              <a href="{{ url('dashboard.administer.invitations') }}"
                class="flex items-center px-2 py-2 text-sm font-medium leading-6 text-gray-300 rounded-md group hover:bg-gray-700">
                <svg class="flex-shrink-0 w-6 h-6 ml-1 mr-4 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
                </svg>

                <span x-show="$store.sidebarExpanded.on">Invitations </span>
              </a>
              <a href="#"
                class="flex items-center px-2 py-2 text-sm font-medium leading-6 text-gray-300 rounded-md group hover:bg-gray-700">
                <svg class="flex-shrink-0 w-6 h-6 ml-1 mr-4 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 00-1.032-.211 50.89 50.89 0 00-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 002.433 3.984L7.28 21.53A.75.75 0 016 21v-4.03a48.527 48.527 0 01-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979z" />
                    <path d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 001.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0015.75 7.5z" />
                </svg>

                <span x-show="$store.sidebarExpanded.on">Support </span>
              </a>

          </div>

        </nav>
      </div>
</div>