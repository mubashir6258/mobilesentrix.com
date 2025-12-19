@props(['title' => 'Featured Products', 'products' => []])

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">{{ $title }}</h2>
            <a href="#" class="text-primary hover:text-primary-dark transition">
                View All
                <svg class="inline w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
                <x-product.card :product="$product" />
            @empty
                @for($i = 0; $i < 4; $i++)
                    <x-product.card />
                @endfor
            @endforelse
        </div>
    </div>
</section>
