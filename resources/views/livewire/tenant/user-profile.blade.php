@section('header')
    <header class="flex justify-between px-8 py-6">
        <h1 class="text-4xl font-bold leading-7 text-emerald-900 sm:leading-9">My Profile</h1>
        <div class="flex gap-6">
            <a href="#" class="inline-flex items-center text-emerald-800 hover:text-emerald-900">
                <x-heroicon-s-chat-alt-2 class="w-6 h-6 mr-3 "/>
                <span>5 Assignments</span>
            </a>
            <a href="#" class="inline-flex items-center text-emerald-800 hover:text-emerald-900">
                <x-heroicon-s-chat-alt-2 class="w-6 h-6 mr-3 "/>
                <span>12 Certificates</span>
            </a>
        </div>
    </header>
@endsection

<div>
    <div class="px-8 py-12 space-y-8 bg-gray-100">
        <section>
            <div class="pb-6 border-b-2 border-gray-300">
                <h3 class="text-xl font-bold text-emerald-800">Leaderboards</h3>
            </div>
        </section>

        <section>
            <div class="pb-6 border-b-2 border-gray-300">
                <h3 class="text-xl font-bold text-emerald-800">Reports</h3>
            </div>
        </section>

        <section>
            <div class="pb-6 border-b-2 border-gray-300">
                <h3 class="text-xl font-bold text-emerald-800">Recommended</h3>
            </div>
        </section>

    </div>
</div>
