{{-- This view represents a blog page layout with a post list occupying most of the space and a side bar containing
search and categories functionalities. --}}
<x-app-layout title="Blog">
    <!-- Main grid layout with 4 columns and a gap of 10 -->
    <div class="grid w-full grid-cols-4 gap-10">
        <!-- Main content area spanning 3 columns on medium screens and full width on smaller screens -->
        <div class="col-span-4 md:col-span-3">
            <!-- Including a livewire component to display the list of posts -->
            <livewire:post-list />
        </div>
        <!-- Sidebar section -->
        <div id="side-bar"
            class="sticky top-0 h-screen col-span-4 px-3 py-6 pt-10 space-y-10 border-t border-gray-100 border-t-gray-100 md:border-t-none md:col-span-1 md:px-6 md:border-l">
            <!-- Including search box partial -->
            @include('posts.partials.search-box')

            <!-- Including categories box partial -->
            @include('posts.partials.categories-box')
        </div>
    </div>

</x-app-layout>
