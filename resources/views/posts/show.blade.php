{{-- This view displays a single post with its title, author, reading time, publication date,
thumbnail, body content, categories, and comment section. --}}

<x-app-layout :title="$post->title">
    <!-- This section sets the title of the page to the title of the post -->
    <article class="w-full col-span-4 py-5 mx-auto mt-10 md:col-span-3" style="max-width:700px">
        <!-- This section displays the thumbnail image of the post -->
        <img class="w-full my-2 rounded-lg" src="{{ $post->getThumbnailUrl() }}" alt="thumbnail">
        <!-- This section displays the title of the post -->
        <h1 class="text-4xl font-bold text-left text-gray-800">
            {{ $post->title }}
        </h1>
        <!-- This section displays the post's author and reading time -->
        <div class="flex items-center justify-between mt-2">
            <div class="flex items-center py-5">
                <x-posts.author :author="$post->author" size="md" />
                <span class="text-sm text-gray-500">| {{ $post->getReadingTime() }} min read</span>
            </div>
            <div class="flex items-center">
                <!-- This displays the published date of the post -->
                <span class="mr-2 text-gray-500">{{ $post->published_at->diffForHumans() }}</span>
                <!-- This displays an icon representing the publication status -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.3"
                    stroke="currentColor" class="w-5 h-5 text-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <!-- This section contains actions related to the article -->
        <div
            class="flex items-center justify-between px-2 py-4 my-6 text-sm border-t border-b border-gray-100 article-actions-bar">
            <div class="flex items-center">
                <!-- This includes a like button for the post -->
                <livewire:like-button :key="'like-' . $post->id" :$post />
            </div>
            <div>
                <div class="flex items-center">
                </div>
            </div>
        </div>

        <!-- This section displays the body content of the post -->
        <div class="py-3 text-lg prose text-justify text-gray-800 article-content">
            {!! $post->body !!}
        </div>

        <!-- This section displays the categories of the post -->
        <div class="flex items-center mt-10 space-x-4">
            @foreach ($post->categories as $category)
            <x-posts.category-badge :category="$category" />
            @endforeach
        </div>

        <!-- This section includes the comment section for the post -->
        <livewire:post-comments :key="'comments' . $post->id" :$post />
    </article>
</x-app-layout>
