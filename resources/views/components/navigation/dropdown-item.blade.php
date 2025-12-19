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
         class="absolute top-full left-0 mt-1 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50"
         @click.away="open = false">
        @foreach($items as $item)
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary transition">
                {{ $item }}
            </a>
        @endforeach
    </div>
</div>
