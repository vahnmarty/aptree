@section('header')
    <header class="flex justify-between px-8 py-6">
        <h1 class="text-4xl font-bold leading-7 text-emerald-900 sm:leading-9">Course Library</h1>
        <div>
            <a href="{{ route('courses.create') }}" type="button" class="btn-primary">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                </svg>

                Create Course
            </a>
        </div>
    </header>
@endsection

<div>
    <div class="px-8 py-12 bg-gray-100">
        <section>

            <div class="flex justify-between pb-2 border-b border-gray-200">
                <div class="sm:hidden">
                    <label for="tabs" class="sr-only">Select a tab</label>
                    <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                    <select id="tabs" name="tabs"
                        class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 rounded-md focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                        <option>Applied</option>

                        <option>Phone Screening</option>

                        <option selected>Interview</option>

                        <option>Offer</option>

                        <option>Disqualified</option>
                    </select>
                </div>
                <div class="hidden sm:block">
                    <div>
                        <nav class="flex -mb-px space-x-4" aria-label="Tabs">

                            <a href="?filter="
                                class="@if ($filter == '') text-indigo-600  @else text-gray-500 @endif flex whitespace-nowrap px-1 py-2 text-sm font-medium"
                                aria-current="page">
                                View All
                                <span
                                    class="@if ($filter == '') text-indigo-600 bg-indigo-100 @else text-gray-900 bg-gray-200 @endif ml-1 hidden rounded-full py-0.5 px-2.5 text-xs font-medium md:inline-block">4</span>
                            </a>

                            <a href="?filter=published"
                                class="@if ($filter == 'published') text-indigo-600  @else text-gray-500 @endif flex whitespace-nowrap px-1 py-2 text-sm font-medium"
                                aria-current="page">
                                Published
                                <span
                                    class="@if ($filter == 'published') text-indigo-600 bg-indigo-100 @else text-gray-900 bg-gray-200 @endif ml-1 hidden rounded-full py-0.5 px-2.5 text-xs font-medium md:inline-block">4</span>
                            </a>

                            <a href="?filter=draft"
                                class="@if ($filter == 'draft') text-indigo-600  @else text-gray-500 @endif flex whitespace-nowrap px-1 py-2 text-sm font-medium"
                                aria-current="page">
                                Drafts
                                <span
                                    class="@if ($filter == 'draft') text-indigo-600 bg-indigo-100 @else text-gray-900 bg-gray-200 @endif ml-1 hidden rounded-full py-0.5 px-2.5 text-xs font-medium md:inline-block">4</span>
                            </a>

                            <a href="?filter=deleted"
                                class="@if ($filter == 'deleted') text-indigo-600  @else text-gray-500 @endif flex whitespace-nowrap px-1 py-2 text-sm font-medium"
                                aria-current="page">
                                Deleted
                                <span
                                    class="@if ($filter == 'deleted') text-indigo-600 bg-indigo-100 @else text-gray-900 bg-gray-200 @endif ml-1 hidden rounded-full py-0.5 px-2.5 text-xs font-medium md:inline-block">4</span>
                            </a>

                            <a href="?filter=template"
                                class="@if ($filter == 'template') text-indigo-600  @else text-gray-500 @endif flex whitespace-nowrap px-1 py-2 text-sm font-medium"
                                aria-current="page">
                                Template
                                <span
                                    class="@if ($filter == 'template') text-indigo-600 bg-indigo-100 @else text-gray-900 bg-gray-200 @endif ml-1 hidden rounded-full py-0.5 px-2.5 text-xs font-medium md:inline-block">4</span>
                            </a>
                        </nav>
                    </div>
                </div>
                <div class="flex gap-2">
                    <select class="text-sm border border-gray-200 rounded-md">
                        <option value="">Filter by Author</option>
                    </select>
                    <select class="text-sm border border-gray-200 rounded-md">
                        <option value="">Filter by category</option>
                    </select>
                </div>
            </div>

        </section>
    </div>
</div>
