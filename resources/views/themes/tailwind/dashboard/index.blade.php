@extends('theme::layouts.app')

@section('header')
<header class="px-8 py-6">
	<h1 class="text-4xl font-bold leading-7 text-emerald-900 sm:leading-9 sm:truncate">Welcome Back, {{ auth()->user()->name }}</h1>
	<p class="mt-8 text-gray-700">
		You're on a roll, you've taken {{ auth()->user()->latest_taken_course_title }} course, and {{ auth()->user()->enrolled_pathways_count }} Paths. Keep on studying!
	</p>
</header>
@endsection

@section('content')

<div class="px-8 py-12 bg-gray-50">

	<section>
		<div class="pb-6 border-b-2 border-gray-300">
			<h3 class="text-xl font-bold text-emerald-800">Courses You're Taking</h3>
			<p class="mt-2">These are the courses you are currently enrolled in.</p>
		</div>
	</section>

</div>

@endsection
