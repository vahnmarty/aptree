<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    
    <title>{{ setting('site.title', 'Aptree') . ' - Course Slider' }}</title>
    

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge"> <!-- † -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ url('/') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ url('/site.webmanifest') }}">

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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</body>
</html>
