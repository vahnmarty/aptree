@extends('theme::layouts.app')

@section('header')
<header class="px-8 py-6 bg-white">
	<h1 class="text-2xl font-bold leading-7 lg:text-4xl text-emerald-900 sm:leading-9 sm:truncate">Welcome Back, {{ auth()->user()->name }}</h1>
	<p class="mt-4 text-gray-700 lg:mt-8">
		You're on a roll, you've taken {{ auth()->user()->latest_taken_course_title }} course, and {{ auth()->user()->enrolled_pathways_count }} Paths. Keep on studying!
	</p>
</header>
@endsection

@section('content')

<div class="px-8 pt-6 pb-32 bg-gray-100">

	@if(count($enrollments))
	<section>
		<div class="pb-6 border-b-2 border-gray-300">
			<h3 class="text-lg font-bold lg:text-xl text-emerald-800">Courses You're Taking</h3>
			<p class="mt-2 text-sm lg:text-base">These are the courses you are currently enrolled in.</p>
		</div>
		<div class="grid grid-cols-2 gap-6 mt-8 lg:grid-cols-2">
			@foreach($enrollments as $enrollment)
			<div class="bg-white border-2 rounded-md">
				<div class="overflow-hidden bg-gray-300 rounded-t-md">
					<img src="{{ $enrollment->course->getImage() }}" alt="" class="w-auto h-32 mx-auto lg:h-64">
				</div>
				<div class="items-center justify-between p-4 lg:p-6 lg:flex">
					<div>
						<h3 class="text-xl font-bold text-emerald-900">{{ $enrollment->course->title }}</h3>
						<div class="gap-3 mt-3 md:flex">
                            <div class="flex items-center gap-1">
                                <x-heroicon-o-template class="w-4 h-4 text-gray-400"/>
                                <span class="text-sm">{{ $enrollment->course->modules()->count() }} modules</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <x-heroicon-o-clock class="w-4 h-4 text-gray-400"/>
                                <span class="text-sm">{{ Carbon\Carbon::parse($enrollment->course->estimated_time)->format('H:i') }} minutes</span>
                            </div>
                        </div>
					</div>
					<div class="mt-4 md:mt-0">
						<a href="{{ route('courses.show', $enrollment->course->id) }}" class="btn-primary">Continue</a>
					</div>
				</div>
			</div>
			@endforeach	
		</div>
	</section>
	@endif

	<section class="mt-8">
		<div class="flex justify-between pb-6 border-b-2 border-gray-300">
			<h3 class="text-xl font-bold text-emerald-800">Library</h3>
			<a href="{{ url('courses') }}" class="inline-flex items-center text-emerald-800">More <x-heroicon-s-chevron-right class="w-4 h-4"/> </a>
		</div>
		<div class="grid grid-cols-2 gap-6 mt-8 lg:grid-cols-3">
			@foreach($libraries as $availableCourse)
			<div class="p-4 bg-white border rounded-md shadow-md">
				<div>
					@if($availableCourse->icon == 'lightning')
					<x-icons.icon-lightning class="w-10 h-10 text-gray-600"/>
					@else
					<x-heroicon-s-academic-cap class="w-10 h-10 text-gray-600"/>
					@endif
				</div>
				<p class="mt-1 text-orange-600">Course</p>
				<h3 class="mt-2 text-lg font-bold">{{ $availableCourse->title }}</h3>
				<div class="text-gray-600">{{ Str::limit($availableCourse->description, 100) }}</div>
				<div class="flex items-center justify-between mt-4">
					<div class="flex gap-3">
						<div class="flex items-center gap-1">
							<x-heroicon-o-template class="flex-shrink-0 w-4 h-4 text-gray-400"/>
							<span class="text-sm">{{ $availableCourse->modules()->count() }} modules</span>
						</div>
						<div class="items-center hidden gap-1 md:flex">
							<x-heroicon-o-clock class="w-4 h-4 text-gray-400"/>
							<span class="text-sm">{{ Carbon\Carbon::parse($availableCourse->estimated_time)->format('H:i') }} minutes</span>
						</div>
					</div>
					<x-dropdown>
						<x-slot name="button">
							<button>
								<x-heroicon-s-dots-vertical class="w-4 h-4 text-gray-400"/>
							</button>
						</x-slot>
						<div>
							<a href="{{ route('courses.show', $availableCourse->id) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 group" role="menuitem"
								tabindex="-1" id="menu-item-0">
								<x-heroicon-s-play  class="w-5 h-5 mr-3 text-gray-400 group-hover:text-gray-500"/>
								Play
							</a>
						</div>
					</x-dropdown>
				</div>
			</div>
			@endforeach	
		</div>
	</section>

</div>

@endsection
