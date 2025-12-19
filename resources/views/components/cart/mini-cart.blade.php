<div x-data="{ cartOpen: false, cartItems: 0 }" class="relative">
    <button @click="cartOpen = !cartOpen" class="block-cart relative">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        <span x-show="cartItems > 0" class="absolute -top-2 -right-2 bg-primary text-white text-xs rounded-full w-5 h-5 flex items-center justify-center" x-text="cartItems"></span>
        <span class="hidden sm:inline">Cart</span>
    </button>

    <!-- Cart Dropdown -->
    <div x-show="cartOpen"
         x-transition
         @click.away="cartOpen = false"
         class="absolute right-0 top-full mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
        <div class="p-4">
            <h3 class="text-lg font-semibold mb-4">Shopping Cart</h3>

            <!-- Empty Cart State -->
            <div x-show="cartItems === 0" class="text-center py-8">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <p class="text-gray-500">Your cart is empty</p>
            </div>

            <!-- Cart Items would go here -->

            <div x-show="cartItems > 0" class="border-t pt-4 mt-4">
                <div class="flex justify-between mb-4">
                    <span class="font-semibold">Subtotal:</span>
                    <span class="font-bold">$0.00</span>
                </div>
                <a href="#" class="btn-primary w-full block text-center">View Cart</a>
            </div>
        </div>
    </div>
</div>
