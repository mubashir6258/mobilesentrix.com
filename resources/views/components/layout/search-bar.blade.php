<div x-data="{ searchOpen: false, searchQuery: '' }" class="relative">
    <div class="relative">
        <input
            type="text"
            x-model="searchQuery"
            @focus="searchOpen = true"
            @click.away="searchOpen = false"
            placeholder="Search for parts..."
            class="w-64 px-4 py-2 pl-10 pr-4 rounded-lg border border-gray-300 focus:outline-none focus:border-primary transition"
        >
        <svg class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </div>

    <!-- Search Results Dropdown -->
    <div x-show="searchOpen && searchQuery.length > 0"
         x-transition
         class="absolute top-full left-0 right-0 mt-2 bg-white rounded-lg shadow-xl border border-gray-200 max-h-96 overflow-y-auto z-50">
        <div class="p-4">
            <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Popular Searches</h3>
            <ul class="space-y-2">
                <li><a href="#" class="block text-sm text-gray-700 hover:text-primary">iPhone 15 Screen</a></li>
                <li><a href="#" class="block text-sm text-gray-700 hover:text-primary">Samsung S24 Battery</a></li>
                <li><a href="#" class="block text-sm text-gray-700 hover:text-primary">Repair Tools Kit</a></li>
            </ul>
        </div>
    </div>
</div>
