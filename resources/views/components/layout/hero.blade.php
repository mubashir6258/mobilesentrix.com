@props(['slides' => []])

<section class="bg-gradient-to-r from-primary to-primary-dark text-white" x-data="{ currentSlide: 0, slides: {{ count($slides) ?: 1 }} }">
    <div class="max-w-7xl mx-auto px-4 py-16 md:py-24">
        @if(count($slides) > 0)
            <div class="relative">
                @foreach($slides as $index => $slide)
                    <div x-show="currentSlide === {{ $index }}"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-x-full"
                         x-transition:enter-end="opacity-100 transform translate-x-0"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 transform translate-x-0"
                         x-transition:leave-end="opacity-0 transform -translate-x-full"
                         class="grid md:grid-cols-2 gap-8 items-center">
                        <div>
                            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $slide['title'] ?? 'Welcome to MobileSentrix' }}</h1>
                            <p class="text-lg md:text-xl mb-8 text-gray-100">{{ $slide['description'] ?? 'Your trusted source for mobile device parts' }}</p>
                            <div class="flex gap-4">
                                <a href="{{ $slide['cta_link'] ?? '#' }}" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                                    {{ $slide['cta_text'] ?? 'Shop Now' }}
                                </a>
                                <a href="#" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-primary transition">
                                    Learn More
                                </a>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <img src="{{ $slide['image'] ?? 'https://via.placeholder.com/600x400?text=Hero+Image' }}" alt="Hero" class="rounded-lg shadow-2xl">
                        </div>
                    </div>
                @endforeach

                @if(count($slides) > 1)
                    <!-- Navigation Arrows -->
                    <button @click="currentSlide = currentSlide > 0 ? currentSlide - 1 : slides - 1" class="absolute left-0 top-1/2 -translate-y-1/2 -ml-4 bg-white text-primary p-2 rounded-full shadow-lg hover:bg-gray-100 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button @click="currentSlide = currentSlide < slides - 1 ? currentSlide + 1 : 0" class="absolute right-0 top-1/2 -translate-y-1/2 -mr-4 bg-white text-primary p-2 rounded-full shadow-lg hover:bg-gray-100 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>

                    <!-- Dots Navigation -->
                    <div class="flex justify-center gap-2 mt-8">
                        @foreach($slides as $index => $slide)
                            <button @click="currentSlide = {{ $index }}" class="w-3 h-3 rounded-full transition" :class="currentSlide === {{ $index }} ? 'bg-white' : 'bg-white/50'"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Welcome to MobileSentrix</h1>
                    <p class="text-lg md:text-xl mb-8 text-gray-100">Your trusted source for mobile device parts and repair solutions</p>
                    <div class="flex gap-4">
                        <a href="#" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                            Shop Now
                        </a>
                        <a href="#" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-primary transition">
                            Learn More
                        </a>
                    </div>
                </div>
                <div class="hidden md:block">
                    <img src="https://via.placeholder.com/600x400?text=Hero+Image" alt="Hero" class="rounded-lg shadow-2xl">
                </div>
            </div>
        @endif
    </div>
</section>
