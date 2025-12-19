<x-layout.app>
    <div class="max-w-[1300px] mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Shopping Cart</h1>

        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8">
            <p class="text-blue-700">
                <strong>Note:</strong> Shopping cart functionality is not yet implemented. This is a placeholder page.
            </p>
        </div>

        <!-- Empty Cart State -->
        <div class="text-center py-12 bg-white rounded-lg shadow">
            <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h2 class="text-2xl font-semibold mb-2">Your cart is empty</h2>
            <p class="text-gray-600 mb-6">Add some items to get started!</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-primary text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-dark transition-colors">
                Continue Shopping
            </a>
        </div>
    </div>
</x-layout.app>
