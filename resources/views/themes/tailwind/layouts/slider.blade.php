<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    @if(isset($seo->title))
        <title>{{ $seo->title }}</title>
    @else
        <title>{{ setting('site.title', 'Laravel Wave') . ' - ' . setting('site.description', 'The Software as a Service Starter Kit built on Laravel & Voyager') }}</title>
    @endif

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge"> <!-- † -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ url('/') }}">

    <link rel="icon" href="{{ setting('site.favicon', '/wave/favicon.png') }}" type="image/x-icon">

    @if(isset($seo->description))
        <meta name="description" content="{{ $seo->description }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @livewireStyles

    @stack('head-scripts')
</head>
<body>

    {{ $slot }}

    @livewireScripts

  

</body>
</html>
