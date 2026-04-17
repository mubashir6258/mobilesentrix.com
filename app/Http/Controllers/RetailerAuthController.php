<?php

namespace App\Http\Controllers;

use App\Models\Retailer;
use App\Models\RetailerAddress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class RetailerAuthController extends Controller
{
    /**
     * Show the retailer registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.retailer-register', [
            'businessTypes' => Retailer::businessTypes(),
            'referralSources' => Retailer::referralSources(),
            'states' => Retailer::usStates(),
        ]);
    }

    /**
     * Handle retailer registration.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            // Account Information
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],

            // Personal Information
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'mobile_phone' => 'nullable|string|max:20',

            // Business Information
            'company_name' => 'required|string|max:255',
            'business_type' => 'required|in:' . implode(',', array_keys(Retailer::businessTypes())),
            'business_type_other' => 'required_if:business_type,other|nullable|string|max:255',
            'tax_id' => 'nullable|string|max:50',
            'website' => 'nullable|url|max:255',
            'years_in_business' => 'nullable|integer|min:0|max:100',
            'estimated_monthly_orders' => 'nullable|integer|min:0',

            // Referral Information
            'referral_source' => 'nullable|in:' . implode(',', array_keys(Retailer::referralSources())),
            'referral_source_other' => 'required_if:referral_source,other|nullable|string|max:255',
            'referral_code' => 'nullable|string|max:50',

            // Business Address
            'business_address_line_1' => 'required|string|max:255',
            'business_address_line_2' => 'nullable|string|max:255',
            'business_city' => 'required|string|max:100',
            'business_state' => 'required|string|max:50',
            'business_zip_code' => 'required|string|max:20',
            'business_country' => 'required|string|max:100',

            // Shipping Address
            'same_as_business' => 'nullable|boolean',
            'shipping_address_line_1' => 'required_without:same_as_business|nullable|string|max:255',
            'shipping_address_line_2' => 'nullable|string|max:255',
            'shipping_city' => 'required_without:same_as_business|nullable|string|max:100',
            'shipping_state' => 'required_without:same_as_business|nullable|string|max:50',
            'shipping_zip_code' => 'required_without:same_as_business|nullable|string|max:20',
            'shipping_country' => 'required_without:same_as_business|nullable|string|max:100',
            'shipping_contact_name' => 'nullable|string|max:255',
            'shipping_contact_phone' => 'nullable|string|max:20',

            // Tax Exemption
            'is_tax_exempt' => 'nullable|boolean',
            'resale_certificate_number' => 'required_if:is_tax_exempt,1|nullable|string|max:100',
            'resale_certificate_state' => 'required_if:is_tax_exempt,1|nullable|string|max:50',
            'resale_certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'business_license_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',

            // Preferences & Terms
            'newsletter_subscribed' => 'nullable|boolean',
            'sms_notifications' => 'nullable|boolean',
            'terms_accepted' => 'required|accepted',
        ], [
            'terms_accepted.required' => 'You must accept the terms and conditions.',
            'terms_accepted.accepted' => 'You must accept the terms and conditions.',
            'password.min' => 'Password must be at least 8 characters.',
            'resale_certificate_number.required_if' => 'Resale certificate number is required for tax exemption.',
            'resale_certificate_state.required_if' => 'Resale certificate state is required for tax exemption.',
        ]);

        DB::beginTransaction();

        try {
            // Create user
            $user = User::create([
                'name' => $validated['first_name'] . ' ' . $validated['last_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'retailer',
            ]);

            // Handle file uploads
            $resaleCertificatePath = null;
            $businessLicensePath = null;

            if ($request->hasFile('resale_certificate_file')) {
                $resaleCertificatePath = $request->file('resale_certificate_file')
                    ->store('retailers/certificates', 'public');
            }

            if ($request->hasFile('business_license_file')) {
                $businessLicensePath = $request->file('business_license_file')
                    ->store('retailers/licenses', 'public');
            }

            // Create retailer profile
            $retailer = Retailer::create([
                'user_id' => $user->id,
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'phone' => $validated['phone'],
                'mobile_phone' => $validated['mobile_phone'] ?? null,
                'company_name' => $validated['company_name'],
                'business_type' => $validated['business_type'],
                'business_type_other' => $validated['business_type_other'] ?? null,
                'tax_id' => $validated['tax_id'] ?? null,
                'website' => $validated['website'] ?? null,
                'years_in_business' => $validated['years_in_business'] ?? null,
                'estimated_monthly_orders' => $validated['estimated_monthly_orders'] ?? null,
                'referral_source' => $validated['referral_source'] ?? null,
                'referral_source_other' => $validated['referral_source_other'] ?? null,
                'referral_code' => $validated['referral_code'] ?? null,
                'is_tax_exempt' => $request->boolean('is_tax_exempt'),
                'resale_certificate_number' => $validated['resale_certificate_number'] ?? null,
                'resale_certificate_state' => $validated['resale_certificate_state'] ?? null,
                'resale_certificate_file' => $resaleCertificatePath,
                'business_license_file' => $businessLicensePath,
                'tax_exempt_status' => $request->boolean('is_tax_exempt') ? 'pending' : 'pending',
                'status' => 'pending',
                'newsletter_subscribed' => $request->boolean('newsletter_subscribed'),
                'sms_notifications' => $request->boolean('sms_notifications'),
                'terms_accepted' => true,
                'terms_accepted_at' => now(),
            ]);

            // Create business address
            RetailerAddress::create([
                'retailer_id' => $retailer->id,
                'type' => 'business',
                'is_default' => true,
                'address_line_1' => $validated['business_address_line_1'],
                'address_line_2' => $validated['business_address_line_2'] ?? null,
                'city' => $validated['business_city'],
                'state' => $validated['business_state'],
                'zip_code' => $validated['business_zip_code'],
                'country' => $validated['business_country'],
            ]);

            // Create shipping address
            if ($request->boolean('same_as_business')) {
                RetailerAddress::create([
                    'retailer_id' => $retailer->id,
                    'type' => 'shipping',
                    'is_default' => true,
                    'address_line_1' => $validated['business_address_line_1'],
                    'address_line_2' => $validated['business_address_line_2'] ?? null,
                    'city' => $validated['business_city'],
                    'state' => $validated['business_state'],
                    'zip_code' => $validated['business_zip_code'],
                    'country' => $validated['business_country'],
                ]);
            } else {
                RetailerAddress::create([
                    'retailer_id' => $retailer->id,
                    'type' => 'shipping',
                    'is_default' => true,
                    'address_line_1' => $validated['shipping_address_line_1'],
                    'address_line_2' => $validated['shipping_address_line_2'] ?? null,
                    'city' => $validated['shipping_city'],
                    'state' => $validated['shipping_state'],
                    'zip_code' => $validated['shipping_zip_code'],
                    'country' => $validated['shipping_country'],
                    'contact_name' => $validated['shipping_contact_name'] ?? null,
                    'contact_phone' => $validated['shipping_contact_phone'] ?? null,
                ]);
            }

            DB::commit();

            // Log in the user
            Auth::login($user);

            return redirect()->route('retailer.registration.success')
                ->with('success', 'Your retailer account has been created successfully! Our team will review your application and get back to you shortly.');

        } catch (\Exception $e) {
            DB::rollBack();

            // Clean up uploaded files if any
            if ($resaleCertificatePath) {
                Storage::disk('public')->delete($resaleCertificatePath);
            }
            if ($businessLicensePath) {
                Storage::disk('public')->delete($businessLicensePath);
            }

            return back()->withInput()->withErrors([
                'error' => 'An error occurred while creating your account. Please try again.'
            ]);
        }
    }

    /**
     * Show registration success page.
     */
    public function registrationSuccess()
    {
        return view('auth.retailer-register-success');
    }

    /**
     * Show retailer login form.
     */
    public function showLoginForm()
    {
        return view('auth.retailer-login');
    }

    /**
     * Handle retailer login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            // Check if user is a retailer
            if (!$user->isRetailer()) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'This account is not registered as a retailer.',
                ]);
            }

            // Check if retailer account is approved
            if (!$user->retailer->isApproved()) {
                $status = $user->retailer->status;

                if ($status === 'pending') {
                    return redirect()->route('retailer.pending');
                } elseif ($status === 'rejected') {
                    Auth::logout();
                    return back()->withErrors([
                        'email' => 'Your retailer application has been rejected. Please contact support for more information.',
                    ]);
                } elseif ($status === 'suspended') {
                    Auth::logout();
                    return back()->withErrors([
                        'email' => 'Your retailer account has been suspended. Please contact support.',
                    ]);
                }
            }

            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Show pending approval page.
     */
    public function pending()
    {
        $user = Auth::user();

        if (!$user || !$user->isRetailer()) {
            return redirect()->route('retailer.login');
        }

        if ($user->retailer->isApproved()) {
            return redirect()->route('home');
        }

        return view('auth.retailer-pending', [
            'retailer' => $user->retailer,
        ]);
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
