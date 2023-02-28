<div>

    <header class="flex justify-between px-8 py-6">
        <h1 class="text-4xl font-bold leading-7 text-emerald-900 sm:leading-9">Billing</h1>
        <div>
        </div>
    </header>

    <div class="px-8 pb-12">
        <div>
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Select a tab</label>
                <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                <select id="tabs" name="tabs"
                    class="block w-full border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500">
                    <option>My Account</option>

                    <option>Company</option>

                    <option selected>Team Members</option>

                    <option>Billing</option>
                </select>
            </div>
            <div class="hidden sm:block">
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px space-x-8" aria-label="Tabs">
                        <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
                        <a href="#"
                            class="inline-flex items-center px-1 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent group hover:border-gray-300 hover:text-gray-700">
                            <!-- Current: "text-indigo-500", Default: "text-gray-400 group-hover:text-gray-500" -->
                            <svg class="-ml-0.5 mr-2 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                            </svg>
                            <span>Invoices</span>
                        </a>

                        <a href="#"
                            class="inline-flex items-center px-1 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent group hover:border-gray-300 hover:text-gray-700">
                            <svg class="-ml-0.5 mr-2 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M4 16.5v-13h-.25a.75.75 0 010-1.5h12.5a.75.75 0 010 1.5H16v13h.25a.75.75 0 010 1.5h-3.5a.75.75 0 01-.75-.75v-2.5a.75.75 0 00-.75-.75h-2.5a.75.75 0 00-.75.75v2.5a.75.75 0 01-.75.75h-3.5a.75.75 0 010-1.5H4zm3-11a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-1zM7.5 9a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5h-1zM11 5.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-1zm.5 3.5a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5h-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Subscription</span>
                        </a>


                    </nav>
                </div>
            </div>
        </div>
    </div>

</div>
