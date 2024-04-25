{{-- This view represents the navigation bar at the top of the page, containing links to different sections of the
website and displaying different content based on whether the user is authenticated or not. --}}
<nav class="flex items-center justify-between px-6 py-3 border-b border-gray-100">
    <!-- Left section of the navigation bar -->
    <div id="nav-left" class="flex items-center">
        <!-- Logo link -->
        <a href="{{ route('home') }}">
            <x-application-mark />
        </a>
        <!-- Top menu with home and blog links -->
        <div class="ml-10 top-menu">
            <div class="flex space-x-4">
                <!-- Home link -->
                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                    {{ __('menu.home') }}
                </x-nav-link>
                <!-- Blog link -->
                <x-nav-link href="{{ route('posts.index') }}" :active="request()->routeIs('posts.index')">
                    {{ __('menu.blog') }}
                </x-nav-link>
            </div>
        </div>
    </div>
    <!-- Right section of the navigation bar -->
    <div id="nav-right" class="flex items-center md:space-x-6">
        <!-- Display different content for authenticated and guest users -->
        @auth
        <!-- Include content for authenticated users -->
        @include('layouts.partials.header-right-auth')
        @else
        <!-- Include content for guest users -->
        @include('layouts.partials.header-right-guest')
        @endauth
    </div>
</nav>
