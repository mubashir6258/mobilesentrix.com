@props(['title', 'items'])

<div class="group relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
    <button class="nav-link flex items-center gap-1">
        {{ $title }}
        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <div x-show="open"
         x-transition
         class="mega-menu custom-scrollbar"
         @click.away="open = false">
        <div class="mega-menu-container py-6">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($items as $item)
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-3">{{ $item['name'] }}</h3>
                        <ul class="space-y-2">
                            @foreach($item['subcategories'] ?? [] as $subcategory)
                                <li>
                                    <a href="#" class="text-sm text-gray-600 hover:text-primary transition">
                                        {{ $subcategory }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
