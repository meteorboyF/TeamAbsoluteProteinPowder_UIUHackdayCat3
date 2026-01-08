<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-secondary-900 text-white antialiased dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="flex min-h-full flex-col justify-center sm:px-6 lg:px-8 bg-secondary-950 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-secondary-800 via-secondary-950 to-secondary-950">
    <!-- Background effects -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-1/2 left-1/2 -ml-[40rem] w-[80rem] h-[80rem] rounded-full bg-primary-500/10 blur-3xl opacity-50"></div>
        <div class="absolute top-0 right-0 -mr-20 w-[40rem] h-[40rem] rounded-full bg-primary-400/5 blur-3xl opacity-30"></div>
    </div>

    <div class="relative sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-white font-display tracking-tight">
            {{ config('app.name', 'AppLogo') }}
        </h2>
    </div>

    <div class="relative mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        {{ $slot }}
    </div>

    <x-ui.toast />
    @livewireScripts
</body>
</html>
