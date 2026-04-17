<x-layout.app>
    <x-slot name="title">Create Retailer Account</x-slot>

    <div class="bg-gray-50 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Create Retailer Account</h1>
                <p class="mt-2 text-gray-600">Join MobileSentrix and access wholesale pricing on mobile device parts</p>
                <p class="mt-1 text-sm text-gray-500">
                    Already have an account?
                    <a href="{{ route('retailer.login') }}" class="text-primary-600 hover:text-primary-700 font-medium">Sign in here</a>
                </p>
            </div>

            <!-- Important Notice -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Business Accounts Only</h3>
                        <p class="mt-1 text-sm text-blue-700">
                            MobileSentrix is a B2B wholesale company. All accounts require business documentation for approval.
                            Your application will be reviewed by our onboarding team.
                        </p>
                    </div>
                </div>
            </div>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-8">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('retailer.register.submit') }}" method="POST" enctype="multipart/form-data" x-data="retailerForm()" class="space-y-8">
                @csrf

                <!-- Section 1: Account Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary-600 text-white text-sm font-bold mr-2">1</span>
                            Account Information
                        </h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email Address <span class="text-red-500">*</span></label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password <span class="text-red-500">*</span></label>
                                <input type="password" name="password" id="password" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('password') border-red-500 @enderror">
                                <p class="mt-1 text-xs text-gray-500">Minimum 8 characters with uppercase, lowercase, and numbers</p>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password <span class="text-red-500">*</span></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Personal Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary-600 text-white text-sm font-bold mr-2">2</span>
                            Personal Information
                        </h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name <span class="text-red-500">*</span></label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('first_name') border-red-500 @enderror">
                                @error('first_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name <span class="text-red-500">*</span></label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('last_name') border-red-500 @enderror">
                                @error('last_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number <span class="text-red-500">*</span></label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required placeholder="(555) 555-5555"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('phone') border-red-500 @enderror">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="mobile_phone" class="block text-sm font-medium text-gray-700">Mobile Phone</label>
                                <input type="tel" name="mobile_phone" id="mobile_phone" value="{{ old('mobile_phone') }}" placeholder="(555) 555-5555"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Business Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary-600 text-white text-sm font-bold mr-2">3</span>
                            Business Information
                        </h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="company_name" class="block text-sm font-medium text-gray-700">Company/Business Name <span class="text-red-500">*</span></label>
                                <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('company_name') border-red-500 @enderror">
                                @error('company_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="business_type" class="block text-sm font-medium text-gray-700">Business Type <span class="text-red-500">*</span></label>
                                <select name="business_type" id="business_type" required x-model="businessType"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('business_type') border-red-500 @enderror">
                                    <option value="">Select Business Type</option>
                                    @foreach($businessTypes as $value => $label)
                                        <option value="{{ $value }}" {{ old('business_type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('business_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div x-show="businessType === 'other'" x-cloak>
                            <label for="business_type_other" class="block text-sm font-medium text-gray-700">Please Specify Business Type <span class="text-red-500">*</span></label>
                            <input type="text" name="business_type_other" id="business_type_other" value="{{ old('business_type_other') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="tax_id" class="block text-sm font-medium text-gray-700">Tax ID / EIN</label>
                                <input type="text" name="tax_id" id="tax_id" value="{{ old('tax_id') }}" placeholder="XX-XXXXXXX"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                <p class="mt-1 text-xs text-gray-500">Federal Employer Identification Number</p>
                            </div>
                            <div>
                                <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                                <input type="url" name="website" id="website" value="{{ old('website') }}" placeholder="https://www.example.com"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="years_in_business" class="block text-sm font-medium text-gray-700">Years in Business</label>
                                <input type="number" name="years_in_business" id="years_in_business" value="{{ old('years_in_business') }}" min="0" max="100"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            </div>
                            <div>
                                <label for="estimated_monthly_orders" class="block text-sm font-medium text-gray-700">Estimated Monthly Orders</label>
                                <select name="estimated_monthly_orders" id="estimated_monthly_orders"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                    <option value="">Select Range</option>
                                    <option value="10" {{ old('estimated_monthly_orders') == '10' ? 'selected' : '' }}>1-10 orders</option>
                                    <option value="25" {{ old('estimated_monthly_orders') == '25' ? 'selected' : '' }}>11-25 orders</option>
                                    <option value="50" {{ old('estimated_monthly_orders') == '50' ? 'selected' : '' }}>26-50 orders</option>
                                    <option value="100" {{ old('estimated_monthly_orders') == '100' ? 'selected' : '' }}>51-100 orders</option>
                                    <option value="200" {{ old('estimated_monthly_orders') == '200' ? 'selected' : '' }}>101-200 orders</option>
                                    <option value="500" {{ old('estimated_monthly_orders') == '500' ? 'selected' : '' }}>200+ orders</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="referral_source" class="block text-sm font-medium text-gray-700">How did you hear about us?</label>
                                <select name="referral_source" id="referral_source" x-model="referralSource"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                    <option value="">Select One</option>
                                    @foreach($referralSources as $value => $label)
                                        <option value="{{ $value }}" {{ old('referral_source') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="referral_code" class="block text-sm font-medium text-gray-700">Referral Code</label>
                                <input type="text" name="referral_code" id="referral_code" value="{{ old('referral_code') }}" placeholder="Enter referral code if you have one"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            </div>
                        </div>

                        <div x-show="referralSource === 'other'" x-cloak>
                            <label for="referral_source_other" class="block text-sm font-medium text-gray-700">Please Specify</label>
                            <input type="text" name="referral_source_other" id="referral_source_other" value="{{ old('referral_source_other') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        </div>
                    </div>
                </div>

                <!-- Section 4: Business Address -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary-600 text-white text-sm font-bold mr-2">4</span>
                            Business Address
                        </h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <label for="business_address_line_1" class="block text-sm font-medium text-gray-700">Street Address <span class="text-red-500">*</span></label>
                            <input type="text" name="business_address_line_1" id="business_address_line_1" value="{{ old('business_address_line_1') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('business_address_line_1') border-red-500 @enderror">
                            @error('business_address_line_1')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="business_address_line_2" class="block text-sm font-medium text-gray-700">Address Line 2</label>
                            <input type="text" name="business_address_line_2" id="business_address_line_2" value="{{ old('business_address_line_2') }}" placeholder="Suite, Unit, Building, Floor, etc."
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="business_city" class="block text-sm font-medium text-gray-700">City <span class="text-red-500">*</span></label>
                                <input type="text" name="business_city" id="business_city" value="{{ old('business_city') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('business_city') border-red-500 @enderror">
                                @error('business_city')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="business_state" class="block text-sm font-medium text-gray-700">State <span class="text-red-500">*</span></label>
                                <select name="business_state" id="business_state" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('business_state') border-red-500 @enderror">
                                    <option value="">Select State</option>
                                    @foreach($states as $code => $name)
                                        <option value="{{ $code }}" {{ old('business_state') == $code ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('business_state')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="business_zip_code" class="block text-sm font-medium text-gray-700">ZIP Code <span class="text-red-500">*</span></label>
                                <input type="text" name="business_zip_code" id="business_zip_code" value="{{ old('business_zip_code') }}" required placeholder="12345"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('business_zip_code') border-red-500 @enderror">
                                @error('business_zip_code')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="business_country" class="block text-sm font-medium text-gray-700">Country <span class="text-red-500">*</span></label>
                            <select name="business_country" id="business_country" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                <option value="United States" selected>United States</option>
                                <option value="Canada">Canada</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Section 5: Shipping Address -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary-600 text-white text-sm font-bold mr-2">5</span>
                            Shipping Address
                        </h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="same_as_business" id="same_as_business" value="1" x-model="sameAsBusiness"
                                {{ old('same_as_business') ? 'checked' : '' }}
                                class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                            <label for="same_as_business" class="ml-2 block text-sm text-gray-900">Same as business address</label>
                        </div>

                        <div x-show="!sameAsBusiness" x-cloak class="space-y-6">
                            <div>
                                <label for="shipping_address_line_1" class="block text-sm font-medium text-gray-700">Street Address <span class="text-red-500">*</span></label>
                                <input type="text" name="shipping_address_line_1" id="shipping_address_line_1" value="{{ old('shipping_address_line_1') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            </div>

                            <div>
                                <label for="shipping_address_line_2" class="block text-sm font-medium text-gray-700">Address Line 2</label>
                                <input type="text" name="shipping_address_line_2" id="shipping_address_line_2" value="{{ old('shipping_address_line_2') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="shipping_city" class="block text-sm font-medium text-gray-700">City <span class="text-red-500">*</span></label>
                                    <input type="text" name="shipping_city" id="shipping_city" value="{{ old('shipping_city') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                </div>
                                <div>
                                    <label for="shipping_state" class="block text-sm font-medium text-gray-700">State <span class="text-red-500">*</span></label>
                                    <select name="shipping_state" id="shipping_state"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                        <option value="">Select State</option>
                                        @foreach($states as $code => $name)
                                            <option value="{{ $code }}" {{ old('shipping_state') == $code ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="shipping_zip_code" class="block text-sm font-medium text-gray-700">ZIP Code <span class="text-red-500">*</span></label>
                                    <input type="text" name="shipping_zip_code" id="shipping_zip_code" value="{{ old('shipping_zip_code') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                </div>
                            </div>

                            <div>
                                <label for="shipping_country" class="block text-sm font-medium text-gray-700">Country <span class="text-red-500">*</span></label>
                                <select name="shipping_country" id="shipping_country"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                    <option value="United States" selected>United States</option>
                                    <option value="Canada">Canada</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="shipping_contact_name" class="block text-sm font-medium text-gray-700">Shipping Contact Name</label>
                                    <input type="text" name="shipping_contact_name" id="shipping_contact_name" value="{{ old('shipping_contact_name') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                </div>
                                <div>
                                    <label for="shipping_contact_phone" class="block text-sm font-medium text-gray-700">Shipping Contact Phone</label>
                                    <input type="tel" name="shipping_contact_phone" id="shipping_contact_phone" value="{{ old('shipping_contact_phone') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 6: Tax Exemption -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary-600 text-white text-sm font-bold mr-2">6</span>
                            Tax Exemption (Optional)
                        </h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <p class="text-sm text-yellow-800">
                                <strong>Note:</strong> If you have a valid resale certificate or tax exempt status, you can provide the details below.
                                Your tax exempt status will be reviewed and approved by our team.
                            </p>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_tax_exempt" id="is_tax_exempt" value="1" x-model="isTaxExempt"
                                {{ old('is_tax_exempt') ? 'checked' : '' }}
                                class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                            <label for="is_tax_exempt" class="ml-2 block text-sm text-gray-900">I have a resale certificate / tax exemption</label>
                        </div>

                        <div x-show="isTaxExempt" x-cloak class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="resale_certificate_number" class="block text-sm font-medium text-gray-700">Resale Certificate Number <span class="text-red-500">*</span></label>
                                    <input type="text" name="resale_certificate_number" id="resale_certificate_number" value="{{ old('resale_certificate_number') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                    @error('resale_certificate_number')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="resale_certificate_state" class="block text-sm font-medium text-gray-700">Certificate State <span class="text-red-500">*</span></label>
                                    <select name="resale_certificate_state" id="resale_certificate_state"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                        <option value="">Select State</option>
                                        @foreach($states as $code => $name)
                                            <option value="{{ $code }}" {{ old('resale_certificate_state') == $code ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('resale_certificate_state')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="resale_certificate_file" class="block text-sm font-medium text-gray-700">Upload Resale Certificate</label>
                                    <input type="file" name="resale_certificate_file" id="resale_certificate_file" accept=".pdf,.jpg,.jpeg,.png"
                                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                                    <p class="mt-1 text-xs text-gray-500">PDF, JPG, or PNG (max 5MB)</p>
                                </div>
                                <div>
                                    <label for="business_license_file" class="block text-sm font-medium text-gray-700">Upload Business License</label>
                                    <input type="file" name="business_license_file" id="business_license_file" accept=".pdf,.jpg,.jpeg,.png"
                                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                                    <p class="mt-1 text-xs text-gray-500">PDF, JPG, or PNG (max 5MB)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 7: Preferences & Terms -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary-600 text-white text-sm font-bold mr-2">7</span>
                            Preferences & Terms
                        </h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <input type="checkbox" name="newsletter_subscribed" id="newsletter_subscribed" value="1"
                                    {{ old('newsletter_subscribed') ? 'checked' : '' }}
                                    class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded mt-1">
                                <label for="newsletter_subscribed" class="ml-2 block text-sm text-gray-900">
                                    Subscribe to our newsletter for exclusive deals and product updates
                                </label>
                            </div>

                            <div class="flex items-start">
                                <input type="checkbox" name="sms_notifications" id="sms_notifications" value="1"
                                    {{ old('sms_notifications') ? 'checked' : '' }}
                                    class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded mt-1">
                                <label for="sms_notifications" class="ml-2 block text-sm text-gray-900">
                                    Receive SMS notifications for order updates and promotions
                                </label>
                            </div>

                            <div class="flex items-start">
                                <input type="checkbox" name="terms_accepted" id="terms_accepted" value="1" required
                                    {{ old('terms_accepted') ? 'checked' : '' }}
                                    class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded mt-1 @error('terms_accepted') border-red-500 @enderror">
                                <label for="terms_accepted" class="ml-2 block text-sm text-gray-900">
                                    I agree to the <a href="#" class="text-primary-600 hover:text-primary-700">Terms of Service</a>
                                    and <a href="#" class="text-primary-600 hover:text-primary-700">Privacy Policy</a> <span class="text-red-500">*</span>
                                </label>
                            </div>
                            @error('terms_accepted')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit"
                        class="px-8 py-3 bg-primary-600 text-white font-semibold rounded-lg shadow-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-colors duration-200">
                        Create Retailer Account
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function retailerForm() {
            return {
                businessType: '{{ old('business_type', '') }}',
                referralSource: '{{ old('referral_source', '') }}',
                sameAsBusiness: {{ old('same_as_business') ? 'true' : 'false' }},
                isTaxExempt: {{ old('is_tax_exempt') ? 'true' : 'false' }},
            }
        }
    </script>
    @endpush
</x-layout.app>
