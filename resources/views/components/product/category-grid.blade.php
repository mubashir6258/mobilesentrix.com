@props(['categories' => []])

<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Shop by Category</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @forelse($categories as $category)
                <a href="{{ $category['url'] ?? '#' }}" class="group">
                    <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-lg transition-all hover:bg-primary hover:text-white">
                        <div class="mb-4">
                            @if(isset($category['icon']))
                                <img src="{{ $category['icon'] }}" alt="{{ $category['name'] }}" class="w-16 h-16 mx-auto">
                            @else
                                <div class="w-16 h-16 mx-auto bg-gray-200 rounded-full flex items-center justify-center group-hover:bg-white">
                                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <h3 class="font-semibold text-sm">{{ $category['name'] ?? 'Category' }}</h3>
                        @if(isset($category['count']))
                            <p class="text-xs mt-1 opacity-75">{{ $category['count'] }} items</p>
                        @endif
                    </div>
                </a>
            @empty
                @foreach(['Apple', 'Samsung', 'LG', 'Google', 'Tools', 'Accessories'] as $cat)
                    <a href="#" class="group">
                        <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-lg transition-all hover:bg-primary hover:text-white">
                            <div class="mb-4">
                                <div class="w-16 h-16 mx-auto bg-gray-200 rounded-full flex items-center justify-center group-hover:bg-white">
                                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="font-semibold text-sm">{{ $cat }}</h3>
                        </div>
                    </a>
                @endforeach
            @endforelse
        </div>
    </div>
</section>
