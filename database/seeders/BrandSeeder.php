<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Genuine OEM',
                'slug' => 'genuine-oem',
                'description' => 'Original Equipment Manufacturer parts directly from device manufacturers',
                'is_active' => true,
            ],
            [
                'name' => 'Premium Aftermarket',
                'slug' => 'premium-aftermarket',
                'description' => 'High-quality third-party parts that meet or exceed OEM specifications',
                'is_active' => true,
            ],
            [
                'name' => 'Standard Aftermarket',
                'slug' => 'standard-aftermarket',
                'description' => 'Quality third-party replacement parts at affordable prices',
                'is_active' => true,
            ],
            [
                'name' => 'iFixit',
                'slug' => 'ifixit',
                'description' => 'Professional-grade repair tools and parts from iFixit',
                'is_active' => true,
            ],
            [
                'name' => 'OEM Pull (Refurbished)',
                'slug' => 'oem-pull-refurbished',
                'description' => 'Genuine OEM parts pulled from devices and professionally refurbished',
                'is_active' => true,
            ],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
