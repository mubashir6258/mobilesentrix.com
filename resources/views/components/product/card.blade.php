@props(['product' => null])

<div class="product-card group">
    <div class="relative overflow-hidden rounded-lg mb-4">
        <img
            src="{{ $product['image'] ?? 'https://via.placeholder.com/300x300?text=Product' }}"
            alt="{{ $product['name'] ?? 'Product' }}"
            class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300"
        >
        @if(isset($product['badge']))
            <span class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">
                {{ $product['badge'] }}
            </span>
        @endif
    </div>

    <div class="space-y-2">
        <h3 class="font-semibold text-gray-900 line-clamp-2 group-hover:text-primary transition">
            {{ $product['name'] ?? 'Product Name' }}
        </h3>

        @if(isset($product['sku']))
            <p class="text-xs text-gray-500">SKU: {{ $product['sku'] }}</p>
        @endif

        @if(isset($product['rating']))
            <div class="flex items-center gap-1">
                @for($i = 0; $i < 5; $i++)
                    <svg class="w-4 h-4 {{ $i < $product['rating'] ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                @endfor
                <span class="text-xs text-gray-500 ml-1">({{ $product['reviews'] ?? 0 }})</span>
            </div>
        @endif

        <div class="flex items-center justify-between pt-2">
            <div>
                @if(isset($product['original_price']) && $product['original_price'] > $product['price'])
                    <span class="text-sm text-gray-400 line-through">${{ number_format($product['original_price'], 2) }}</span>
                @endif
                <div class="text-xl font-bold text-primary">
                    ${{ number_format($product['price'] ?? 0, 2) }}
                </div>
            </div>

            <button class="bg-primary text-white p-2 rounded-lg hover:bg-primary-dark transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </button>
        </div>

        @if(isset($product['stock']))
            <div class="pt-2">
                @if($product['stock'] > 10)
                    <span class="text-xs text-green-600">In Stock</span>
                @elseif($product['stock'] > 0)
                    <span class="text-xs text-orange-600">Only {{ $product['stock'] }} left</span>
                @else
                    <span class="text-xs text-red-600">Out of Stock</span>
                @endif
            </div>
        @endif
    </div>
</div>
