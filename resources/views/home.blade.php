<x-layout.app>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-orange-500 to-orange-600 text-white py-20">
        <div class="max-w-[1300px] mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Welcome to MobileSentrix</h1>
                <p class="text-xl mb-8">Your Trusted Source for Mobile Phone Parts & Accessories</p>
                <div class="flex justify-center gap-4">
                    <a href="{{ url('/products') }}" class="bg-white text-orange-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">Shop Now</a>
                    <a href="{{ url('/about-us') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-orange-600 transition-colors">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Categories -->
    <section class="py-16">
        <div class="max-w-[1300px] mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Shop by Brand</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <a href="{{ url('/apple') }}" class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow p-6 text-center group">
                    <div class="h-32 flex items-center justify-center mb-4">
                        <svg class="w-24 h-24 text-gray-800 group-hover:text-orange-600 transition-colors" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Apple</h3>
                    <p class="text-sm text-gray-600">iPhone, iPad, MacBook</p>
                </a>

                <a href="{{ url('/samsung') }}" class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow p-6 text-center group">
                    <div class="h-32 flex items-center justify-center mb-4">
                        <div class="text-5xl font-bold text-gray-800 group-hover:text-orange-600 transition-colors">S</div>
                    </div>
                    <h3 class="text-lg font-semibold">Samsung</h3>
                    <p class="text-sm text-gray-600">Galaxy S, Note, A Series</p>
                </a>

                <a href="{{ url('/lg') }}" class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow p-6 text-center group">
                    <div class="h-32 flex items-center justify-center mb-4">
                        <div class="text-5xl font-bold text-gray-800 group-hover:text-orange-600 transition-colors">LG</div>
                    </div>
                    <h3 class="text-lg font-semibold">LG</h3>
                    <p class="text-sm text-gray-600">G, V, K Series</p>
                </a>

                <a href="{{ url('/google-pixel') }}" class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow p-6 text-center group">
                    <div class="h-32 flex items-center justify-center mb-4">
                        <svg class="w-24 h-24 text-gray-800 group-hover:text-orange-600 transition-colors" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                            <circle cx="12" cy="12" r="5"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Google Pixel</h3>
                    <p class="text-sm text-gray-600">Pixel 8, 7, 6</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="bg-gray-100 py-16">
        <div class="max-w-[1300px] mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Why Choose MobileSentrix?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Quality Guaranteed</h3>
                    <p class="text-gray-600">All parts are tested and come with warranty</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Fast Shipping</h3>
                    <p class="text-gray-600">Same-day shipping on orders placed before cutoff time</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Expert Support</h3>
                    <p class="text-gray-600">Dedicated customer service team ready to help</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="bg-orange-600 text-white py-12">
        <div class="max-w-[1300px] mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Stay Updated</h2>
            <p class="text-lg mb-6">Subscribe to our newsletter for exclusive deals and updates</p>
            <form action="{{ url('/newsletter/subscribe') }}" method="POST" class="max-w-md mx-auto flex gap-2">
                @csrf
                <input type="email" name="email" placeholder="Enter your email" class="flex-1 px-4 py-3 rounded-lg text-gray-800 focus:outline-none" required>
                <button type="submit" class="bg-white text-orange-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">Subscribe</button>
            </form>
        </div>
    </section>
</x-layout.app>
