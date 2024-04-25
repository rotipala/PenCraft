<!-- This view renders a footer containing links to switch between supported locales and common menu items such as login, profile, and blog. -->

<footer class="flex flex-wrap items-center justify-between px-4 py-4 text-sm border-t border-gray-100 ">

    <div class="flex space-x-4">
        @foreach (config('app.supported_locales') as $locale => $data)
        <a href="{{ route('locale', $locale) }}">
            {{--
            <x-dynamic-component :component="'flag-country-' . $data['icon']" class="w-6 h-6" /> --}}
        </a>
        @endforeach
    </div>
    <!-- This section contains links to common menu items such as login, profile, and blog. -->
    <div class="flex space-x-4">
        <a class="text-gray-500 hover:text-purple-500" href="">{{ __('menu.login') }} </a>
        <a class="text-gray-500 hover:text-purple-500" href="">{{ __('menu.profile') }} </a>
        <a class="text-gray-500 hover:text-purple-500" href="">{{ __('menu.blog') }} </a>
    </div>
</footer>
