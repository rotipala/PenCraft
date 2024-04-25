{{-- This view represents the home page layout, including a hero section with a title, description, and call-to-action
button,
featured posts section, and latest posts section. It dynamically renders post cards for featured and latest posts
fetched from the controller, and provides a link to view more posts. --}}

<x-app-layout title="Home Page">
    {{-- Hero Section:
    This section displays a prominent header with a title, a subheading, and a call-to-action button.
    It dynamically fetches the title and description from language files and includes a link to the posts index page.
    --}}
    @section('hero')
    <div class="w-full py-32 text-center">
        <h1 class="text-2xl font-bold text-center text-gray-700 md:text-3xl lg:text-5xl">
            {{ __('home.hero.title') }} <span class="text-purple-500">&lt;PenCraft &gt;</span> <span
                class="text-gray-900">
                News</span>
        </h1>
        <p class="mt-1 text-lg text-gray-500">{{ __('home.hero.desc') }}</p>
        <a class="inline-block px-3 py-2 mt-5 text-lg text-white bg-gray-800 rounded" href="{{ route('posts.index') }}">
            {{ __('home.hero.cta') }}</a>
    </div>
    @endsection
    {{-- Featured Posts Section:
    This section displays a grid layout of featured posts fetched from the controller.
    Each post is rendered using a post card component, and the layout adjusts responsively.
    It includes a link to view more posts in the posts index page --}}
    <div class="w-full mb-10">
        <div class="mb-16">
            <h2 class="mt-16 mb-5 text-3xl font-bold text-purple-500"> {{ __('home.featured_posts') }} </h2>
            <div class="w-full">
                <div class="grid w-full grid-cols-3 gap-10">
                    @foreach ($featuredPosts as $post)
                    <x-posts.post-card :post="$post" class="col-span-3 md:col-span-1" />
                    @endforeach
                </div>
            </div>
            <a class="block mt-10 text-lg font-semibold text-center text-purple-500" href="{{ route('posts.index') }}">
                {{ __('home.more_posts') }}</a>
        </div>
        <hr>
        {{-- Latest Posts Section:
        This section displays a grid layout of the latest posts fetched from the controller.
        Similar to the featured posts section, each post is rendered using a post card component.
        It also includes a link to view more posts in the posts index page. --}}
        <h2 class="mt-16 mb-5 text-3xl font-bold text-purple-500">{{ __('home.latest_posts') }}</h2>
        <div class="w-full mb-5">
            <div class="grid w-full grid-cols-3 gap-10">
                @foreach ($latestPosts as $post)
                <x-posts.post-card :post="$post" class="col-span-3 md:col-span-1" />
                @endforeach
            </div>
        </div>
        <a class="block mt-10 text-lg font-semibold text-center text-purple-500" href="{{ route('posts.index') }}">
            {{ __('home.more_posts') }}</a>
    </div>
</x-app-layout>
