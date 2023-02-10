@extends('theme::layouts.blank')

@section('content')


<div class="flex min-h-screen bg-gray-200">
    <div class="flex flex-col justify-center flex-1 px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
      <div class="w-full max-w-sm mx-auto lg:w-96">
        <div>
            <img class="w-auto h-12" src="{{ global_asset('img/logo.png') }}" alt="Your Company">
            <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">{{ tenancy()->tenant->name }}</h2>
        </div>
  
        <div class="mt-8">
  
          <div class="mt-6">
            <form action="#" method="POST">
                @csrf
                <div>

                    @if(setting('auth.email_or_username') && setting('auth.email_or_username') == 'username')
                        <label for="username" class="block text-sm font-medium leading-5 text-gray-700">Username</label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="username" type="username" name="username" required class="w-full form-input" autofocus>
                        </div>

                        @if ($errors->has('username'))
                            <div class="mt-1 text-red-500">
                                {{ $errors->first('username') }}
                            </div>
                        @endif
                    @else
                        <label for="email" class="block text-sm font-medium leading-5 text-gray-700">Email address</label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="email" type="email" name="email" required class="w-full form-input" autofocus>
                        </div>

                        @if ($errors->has('email'))
                            <div class="mt-1 text-red-500">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    @endif


                </div>

                <div class="mt-6">
                    <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                        Password
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="password" type="password" name="password" required class="w-full form-input">
                    </div>
                    @if ($errors->has('password'))
                        <div class="mt-1 text-red-500">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="text-indigo-600 border-0 border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50 rounded-xl" {{ old('remember') ? ' checked' : '' }}>
                        <label for="remember" class="block ml-2 text-sm leading-5 text-gray-900">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm leading-5">
                        <a href="{{ route('password.request') }}" class="font-medium transition duration-150 ease-in-out text-wave-600 hover:text-wave-500 focus:outline-none focus:underline">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-wave-600 hover:bg-wave-500 focus:outline-none focus:border-wave-700 focus:shadow-outline-wave active:bg-wave-700 bg-emerald-700">
                            Sign in
                        </button>
                    </span>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="relative flex-1 hidden w-0 border-l-2 border-gray-400 lg:block">
      <img class="absolute inset-0 object-cover w-full h-full" src="{{ global_asset('img/hero.jpg') }}" alt="">
    </div>
  </div>
  

@endsection
