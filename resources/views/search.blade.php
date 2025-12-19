<x-layout.app>
    <div class="max-w-[1300px] mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Search Results</h1>

        @if($query)
            <p class="text-gray-600 mb-8">
                Showing results for: <strong class="text-gray-900">"{{ $query }}"</strong>
            </p>

            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8">
                <p class="text-blue-700">
                    <strong>Note:</strong> Search functionality is not yet implemented. This is a placeholder page.
                </p>
            </div>

            <!-- Placeholder for search results -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Sample product cards will go here -->
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <div class="h-48 bg-gray-200 rounded mb-4 flex items-center justify-center">
                        <span class="text-gray-400">Product Image</span>
                    </div>
                    <h3 class="font-semibold mb-2">Sample Product</h3>
                    <p class="text-gray-600 text-sm mb-4">Product description here</p>
                    <p class="text-primary font-bold text-lg">$99.99</p>
                    <button class="mt-4 w-full bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark transition-colors">
                        Add to Cart
                    </button>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <h2 class="text-2xl font-semibold mb-2">No search query provided</h2>
                <p class="text-gray-600">Please enter a search term to find products.</p>
            </div>
        @endif
    </div>
</x-layout.app>
