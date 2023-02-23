@extends('theme::layouts.blank')

@section('content')

    <div class="sm:mx-auto sm:w-full sm:max-w-md lg:pt-10">
        <div class="flex items-center">
            <img src="{{ global_asset('img/logo.png') }}" class="w-10 h-10">
            <span class="ml-4 text-2xl font-bold">{{ tenant()->name }}</span>
        </div>
        <h2 class="text-3xl font-extrabold leading-9 text-center text-gray-900 sm:mt-6 lg:text-3xl">
            Complete your Registration
        </h2>
    </div>

    <div class="flex flex-col justify-center pb-10 sm:pb-20 sm:px-6 lg:px-8">


        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-4 py-8 bg-white border shadow border-gray-50 sm:rounded-lg sm:px-10">
                <form role="form" method="POST" action="{{ route('invitation.store') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $invitation->token }}"/>
                    <input type="hidden" name="email" value="{{ $invitation->email }}"/>

                    <div class="mt-6">
                        <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                            Name
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="name" type="text" name="name" required class="w-full form-input" value="{{ old('name') }}" @if(!setting('billing.card_upfront')){{ 'autofocus' }}@endif>
                        </div>
                        @if ($errors->has('name'))
                            <div class="mt-1 text-red-500">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    @if(setting('auth.username_in_registration') && setting('auth.username_in_registration') == 'yes')
                        <div class="mt-6">
                            <label for="username" class="block text-sm font-medium leading-5 text-gray-700">
                                Username
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="username" type="text" name="username" value="{{ old('username') }}" required class="w-full form-input">
                            </div>
                            @if ($errors->has('username'))
                                <div class="mt-1 text-red-500">
                                    {{ $errors->first('username') }}
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="mt-6">
                        <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                            Email Address
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="email" type="email"  value="{{ $email }}" required class="w-full bg-gray-300 cursor-not-allowed" disabled>
                        </div>
                        @if ($errors->has('email'))
                            <div class="mt-1 text-red-500">
                                {{ $errors->first('email') }}
                            </div>
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

                    <div class="mt-6">
                        <label for="password_confirmation" class="block text-sm font-medium leading-5 text-gray-700">
                            Confirm Password
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full form-input">
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <div class="mt-1 text-red-500">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="justify-center w-full mt-8 text-center btn-primary">
                        Register
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
