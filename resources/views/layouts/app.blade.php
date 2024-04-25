{{-- This view template defines the structure for a basic HTML page layout, including meta tags, title, fonts, scripts,
styles, banner, header, hero section, main content slot, footer, and modals. --}}
@props(['title'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title> {{ isset($title) ? $title . ' - ' : '' }}{{ config('app.name', '') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <!-- Banner -->
    <x-banner />

    <!-- Header -->
    @include('layouts.partials.header')

    <!-- Hero Section -->
    @yield('hero')

    <!-- Main Content -->
    <main class="container flex flex-grow px-5 mx-auto">
        {{ $slot }}
    </main>

    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- Modals -->
    @stack('modals')

    <!-- Livewire Scripts -->
    @livewireScripts
</body>

</html>
