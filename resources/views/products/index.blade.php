<x-layout.app>
    <div class="max-w-[1300px] mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">All Products</h1>

        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8">
            <p class="text-blue-700">
                <strong>Note:</strong> Product listings coming soon. This is a placeholder page.
            </p>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h3 class="font-semibold mb-4">Filters</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Brand</label>
                    <select class="w-full border-gray-300 rounded-md">
                        <option>All Brands</option>
                        <option>Apple</option>
                        <option>Samsung</option>
                        <option>LG</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Category</label>
                    <select class="w-full border-gray-300 rounded-md">
                        <option>All Categories</option>
                        <option>LCD Screens</option>
                        <option>Batteries</option>
                        <option>Cameras</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Price Range</label>
                    <select class="w-full border-gray-300 rounded-md">
                        <option>All Prices</option>
                        <option>Under $50</option>
                        <option>$50 - $100</option>
                        <option>Over $100</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button class="w-full bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-dark">
                        Apply Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Product Grid Placeholder -->
        <div class="text-center py-12">
            <p class="text-gray-600">Product listings will appear here</p>
        </div>
    </div>
</x-layout.app>
