<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailerAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'retailer_id',
        'type',
        'is_default',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'zip_code',
        'country',
        'contact_name',
        'contact_phone',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function getFullAddressAttribute(): string
    {
        $parts = [
            $this->address_line_1,
            $this->address_line_2,
            $this->city . ', ' . $this->state . ' ' . $this->zip_code,
            $this->country,
        ];

        return implode(', ', array_filter($parts));
    }

    public function getFormattedAddressAttribute(): string
    {
        $lines = [
            $this->address_line_1,
        ];

        if ($this->address_line_2) {
            $lines[] = $this->address_line_2;
        }

        $lines[] = "{$this->city}, {$this->state} {$this->zip_code}";
        $lines[] = $this->country;

        return implode("\n", $lines);
    }
}
