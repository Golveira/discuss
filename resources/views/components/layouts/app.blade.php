<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ isset($title) ? $title . ' | ' : '' }}
        {{ config('app.name') }}
    </title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net" rel="preconnect">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <livewire:toasts />

    <div class="min-h-screen space-y-6 bg-gray-100 dark:bg-gray-900">
        <livewire:layout.navigation />

        <main>
            {{ $slot }}
        </main>

        <x-layouts.footer />
    </div>

    @stack('modals')
    @stack('scripts')
    @livewireScriptConfig
</body>

</html>
