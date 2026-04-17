<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('retailers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Personal Information
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('mobile_phone')->nullable();

            // Business Information
            $table->string('company_name');
            $table->enum('business_type', [
                'repair_shop',
                'distributor',
                'reseller',
                'refurbisher',
                'retailer',
                'wholesaler',
                'other'
            ]);
            $table->string('business_type_other')->nullable();
            $table->string('tax_id')->nullable(); // EIN / Tax ID
            $table->string('website')->nullable();
            $table->integer('years_in_business')->nullable();
            $table->integer('estimated_monthly_orders')->nullable();

            // How did you hear about us
            $table->enum('referral_source', [
                'google_search',
                'social_media',
                'friend_referral',
                'trade_show',
                'advertisement',
                'other'
            ])->nullable();
            $table->string('referral_source_other')->nullable();
            $table->string('referral_code')->nullable();

            // Tax Exemption
            $table->boolean('is_tax_exempt')->default(false);
            $table->string('resale_certificate_number')->nullable();
            $table->string('resale_certificate_state')->nullable();
            $table->string('resale_certificate_file')->nullable();
            $table->string('business_license_file')->nullable();
            $table->enum('tax_exempt_status', ['pending', 'approved', 'rejected'])->default('pending');

            // Account Status
            $table->enum('status', ['pending', 'approved', 'rejected', 'suspended'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();

            // Verification
            $table->boolean('phone_verified')->default(false);
            $table->string('phone_verification_code')->nullable();
            $table->timestamp('phone_verification_sent_at')->nullable();
            $table->boolean('email_verified')->default(false);

            // Preferences
            $table->boolean('newsletter_subscribed')->default(false);
            $table->boolean('sms_notifications')->default(false);
            $table->boolean('terms_accepted')->default(false);
            $table->timestamp('terms_accepted_at')->nullable();

            // Notes (for admin use)
            $table->text('admin_notes')->nullable();

            $table->timestamps();

            $table->index('user_id');
            $table->index('status');
            $table->index('company_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retailers');
    }
};
