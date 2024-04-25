<!-- This view displays a list of recommended topics for blog posts -->
<div>
    {{-- This section contains the heading for the recommended topics --}}
    <h3 class="mb-3 text-lg font-semibold text-gray-900">{{ __('blog.recommended_topics') }}</h3>
    {{-- This section contains a container for the list of recommended topics --}}
    <div class="flex flex-wrap justify-start gap-2 topics">
        {{-- This loop iterates over each category in the provided array --}}
        @foreach ($categories as $category)
        {{-- This includes a component to display a badge for each category --}}
        <x-posts.category-badge :category="$category" />
        @endforeach
    </div>
</div>
