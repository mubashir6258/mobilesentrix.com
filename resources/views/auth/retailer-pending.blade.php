<x-layout.app>
    <x-slot name="title">Account Pending Approval</x-slot>

    <div class="bg-gray-50 min-h-screen py-16">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-yellow-500 px-6 py-8 text-center">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-white mb-4">
                        <svg class="h-8 w-8 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-white">Account Pending Approval</h1>
                    <p class="mt-2 text-yellow-100">Your application is being reviewed</p>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <!-- Account Info -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h3 class="font-semibold text-gray-900 mb-2">Account Information</h3>
                        <dl class="space-y-1 text-sm">
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Company:</dt>
                                <dd class="text-gray-900 font-medium">{{ $retailer->company_name }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Contact:</dt>
                                <dd class="text-gray-900">{{ $retailer->full_name }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Email:</dt>
                                <dd class="text-gray-900">{{ $retailer->user->email }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Applied:</dt>
                                <dd class="text-gray-900">{{ $retailer->created_at->format('M d, Y') }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Status:</dt>
                                <dd>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Pending Review
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Timeline -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-900 mb-4">Application Status</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center">
                                        <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Application Submitted</p>
                                    <p class="text-sm text-gray-500">{{ $retailer->created_at->format('M d, Y h:i A') }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-yellow-500 flex items-center justify-center animate-pulse">
                                        <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Under Review</p>
                                    <p class="text-sm text-gray-500">Our team is reviewing your application</p>
                                </div>
                            </div>

                            <div class="flex items-start opacity-50">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center">
                                        <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Account Approved</p>
                                    <p class="text-sm text-gray-400">Pending</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- What to expect -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <h4 class="font-medium text-blue-900 mb-2">What to expect:</h4>
                        <ul class="text-sm text-blue-800 space-y-1 list-disc list-inside">
                            <li>Review typically takes 1-2 business days</li>
                            <li>You'll receive an email once your account is approved</li>
                            <li>We may contact you for additional documentation</li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div class="text-center text-sm text-gray-600">
                        <p>Need help or have questions?</p>
                        <p class="font-medium text-gray-900">Contact us at onboarding@mobilesentrix.com</p>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-between items-center">
                    <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        &larr; Back to Home
                    </a>
                    <form action="{{ route('retailer.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm text-primary-600 hover:text-primary-700">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
