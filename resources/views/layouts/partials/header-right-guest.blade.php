{{-- This view generates a flex container with space between items containing login and register navigation links, with
active states based on the current route --}}
<div class="flex space-x-5">
    <!-- This x-nav-link generates a login navigation link with an active state if the current route is 'login' -->
    <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
        {{ __('menu.login') }}
    </x-nav-link>
    <!-- This x-nav-link generates a register navigation link with an active state if the current route is 'register' -->
    <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
        {{ __('menu.register') }}
    </x-nav-link>
</div>
