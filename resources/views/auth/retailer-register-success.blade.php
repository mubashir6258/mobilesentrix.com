<x-layout.app>
    <x-slot name="title">Registration Successful</x-slot>

    <div class="bg-gray-50 py-16">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <!-- Success Icon -->
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6">
                    <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-4">Registration Successful!</h1>
                <p class="text-lg text-gray-600 mb-6">
                    Thank you for creating a retailer account with MobileSentrix.
                </p>

                <!-- Status Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8 text-left">
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">What happens next?</h3>
                    <ol class="list-decimal list-inside space-y-2 text-blue-800">
                        <li>Our onboarding team will review your application</li>
                        <li>We may contact you for additional information if needed</li>
                        <li>Once approved, you'll receive an email confirmation</li>
                        <li>You can then start placing orders at wholesale prices</li>
                    </ol>
                    <p class="mt-4 text-sm text-blue-700">
                        <strong>Estimated review time:</strong> 1-2 business days
                    </p>
                </div>

                <!-- Current Status -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-8">
                    <div class="flex items-center justify-center">
                        <svg class="h-5 w-5 text-yellow-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-yellow-800 font-medium">Your account is pending approval</span>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="text-gray-600 mb-8">
                    <p>Have questions? Contact our support team:</p>
                    <p class="font-medium text-gray-900">onboarding@mobilesentrix.com</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Browse Products
                    </a>
                    <a href="{{ route('retailer.pending') }}"
                        class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Check Application Status
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
