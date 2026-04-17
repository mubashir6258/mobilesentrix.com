<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'mobile_phone',
        'company_name',
        'business_type',
        'business_type_other',
        'tax_id',
        'website',
        'years_in_business',
        'estimated_monthly_orders',
        'referral_source',
        'referral_source_other',
        'referral_code',
        'is_tax_exempt',
        'resale_certificate_number',
        'resale_certificate_state',
        'resale_certificate_file',
        'business_license_file',
        'tax_exempt_status',
        'status',
        'rejection_reason',
        'approved_at',
        'approved_by',
        'phone_verified',
        'phone_verification_code',
        'phone_verification_sent_at',
        'email_verified',
        'newsletter_subscribed',
        'sms_notifications',
        'terms_accepted',
        'terms_accepted_at',
        'admin_notes',
    ];

    protected $casts = [
        'is_tax_exempt' => 'boolean',
        'phone_verified' => 'boolean',
        'email_verified' => 'boolean',
        'newsletter_subscribed' => 'boolean',
        'sms_notifications' => 'boolean',
        'terms_accepted' => 'boolean',
        'approved_at' => 'datetime',
        'terms_accepted_at' => 'datetime',
        'phone_verification_sent_at' => 'datetime',
    ];

    /**
     * Business type options.
     */
    public static function businessTypes(): array
    {
        return [
            'repair_shop' => 'Repair Shop',
            'distributor' => 'Distributor',
            'reseller' => 'Reseller',
            'refurbisher' => 'Refurbisher',
            'retailer' => 'Retailer',
            'wholesaler' => 'Wholesaler',
            'other' => 'Other',
        ];
    }

    /**
     * Referral source options.
     */
    public static function referralSources(): array
    {
        return [
            'google_search' => 'Google Search',
            'social_media' => 'Social Media',
            'friend_referral' => 'Friend/Colleague Referral',
            'trade_show' => 'Trade Show/Event',
            'advertisement' => 'Advertisement',
            'other' => 'Other',
        ];
    }

    /**
     * US States list.
     */
    public static function usStates(): array
    {
        return [
            'AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona', 'AR' => 'Arkansas',
            'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware',
            'FL' => 'Florida', 'GA' => 'Georgia', 'HI' => 'Hawaii', 'ID' => 'Idaho',
            'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa', 'KS' => 'Kansas',
            'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 'MD' => 'Maryland',
            'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi',
            'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada',
            'NH' => 'New Hampshire', 'NJ' => 'New Jersey', 'NM' => 'New Mexico', 'NY' => 'New York',
            'NC' => 'North Carolina', 'ND' => 'North Dakota', 'OH' => 'Ohio', 'OK' => 'Oklahoma',
            'OR' => 'Oregon', 'PA' => 'Pennsylvania', 'RI' => 'Rhode Island', 'SC' => 'South Carolina',
            'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas', 'UT' => 'Utah',
            'VT' => 'Vermont', 'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia',
            'WI' => 'Wisconsin', 'WY' => 'Wyoming', 'DC' => 'District of Columbia',
            'PR' => 'Puerto Rico', 'VI' => 'Virgin Islands', 'GU' => 'Guam',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addresses()
    {
        return $this->hasMany(RetailerAddress::class);
    }

    public function businessAddress()
    {
        return $this->hasOne(RetailerAddress::class)->where('type', 'business');
    }

    public function shippingAddress()
    {
        return $this->hasOne(RetailerAddress::class)->where('type', 'shipping');
    }

    public function billingAddress()
    {
        return $this->hasOne(RetailerAddress::class)->where('type', 'billing');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function isSuspended(): bool
    {
        return $this->status === 'suspended';
    }

    public function getBusinessTypeLabel(): string
    {
        return self::businessTypes()[$this->business_type] ?? $this->business_type;
    }

    public function getReferralSourceLabel(): ?string
    {
        if (!$this->referral_source) {
            return null;
        }
        return self::referralSources()[$this->referral_source] ?? $this->referral_source;
    }
}
