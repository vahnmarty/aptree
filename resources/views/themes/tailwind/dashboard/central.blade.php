@extends('theme::layouts.app')

@section('header')
<header class="px-8 py-6 pt-16">
	<h1 class="text-4xl font-bold leading-7 text-emerald-900 sm:leading-9 sm:truncate">Welcome to your Dashboard</h1>
</header>
@endsection

@section('content')

<div class="px-8 pt-6 pb-32 bg-gray-100">

	<div class="grid grid-cols-4 gap-6">
		<a href="" class="block p-4 bg-white border rounded-md shadow-md hover:bg-emerald-50">
			<div>
				<x-heroicon-s-globe class="w-10 h-10 text-gray-600"/>
			</div>
			<h3 class="mt-3 text-lg font-bold text-emerald-800">Organization</h3>
			<p class="mt-1 text-sm">Manage your Accounts.</p>
		</a>

		<a href="" class="block p-4 bg-white border rounded-md shadow-md hover:bg-emerald-50">
			<div>
				<x-heroicon-s-credit-card class="w-10 h-10 text-gray-600"/>
			</div>
			<h3 class="mt-3 text-lg font-bold text-emerald-800">Billing</h3>
			<p class="mt-1 text-sm">Subscriptions and Invoices.</p>
		</a>

		<a href="" class="block p-4 bg-white border rounded-md shadow-md hover:bg-emerald-50">
			<div>
				<x-heroicon-s-puzzle class="w-10 h-10 text-gray-600"/>
			</div>
			<h3 class="mt-3 text-lg font-bold text-emerald-800">Invitations</h3>
			<p class="mt-1 text-sm">View invitation requests.</p>
		</a>


	</div>

</div>

@endsection
