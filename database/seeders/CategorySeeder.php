<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Parent categories (brands)
        $apple = Category::create([
            'name' => 'Apple',
            'slug' => 'apple',
            'description' => 'Apple device parts and accessories',
            'is_active' => true,
            'is_device' => false,
        ]);

        $samsung = Category::create([
            'name' => 'Samsung',
            'slug' => 'samsung',
            'description' => 'Samsung device parts and accessories',
            'is_active' => true,
            'is_device' => false,
        ]);

        $google = Category::create([
            'name' => 'Google',
            'slug' => 'google',
            'description' => 'Google Pixel device parts',
            'is_active' => true,
            'is_device' => false,
        ]);

        $motorola = Category::create([
            'name' => 'Motorola',
            'slug' => 'motorola',
            'description' => 'Motorola device parts',
            'is_active' => true,
            'is_device' => false,
        ]);

        $lg = Category::create([
            'name' => 'LG',
            'slug' => 'lg',
            'description' => 'LG device parts',
            'is_active' => true,
            'is_device' => false,
        ]);

        $tools = Category::create([
            'name' => 'Tools & Accessories',
            'slug' => 'tools-accessories',
            'description' => 'Repair tools and accessories',
            'is_active' => true,
            'is_device' => false,
        ]);

        // Apple device subcategories (is_device = true)
        $iphone = Category::create([
            'name' => 'iPhone',
            'slug' => 'iphone',
            'description' => 'iPhone parts and accessories',
            'parent_id' => $apple->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        $ipad = Category::create([
            'name' => 'iPad',
            'slug' => 'ipad',
            'description' => 'iPad parts and accessories',
            'parent_id' => $apple->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        Category::create([
            'name' => 'Mac',
            'slug' => 'mac',
            'description' => 'Mac parts and accessories',
            'parent_id' => $apple->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        Category::create([
            'name' => 'Apple Watch',
            'slug' => 'apple-watch',
            'description' => 'Apple Watch parts and accessories',
            'parent_id' => $apple->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        Category::create([
            'name' => 'AirPods',
            'slug' => 'airpods',
            'description' => 'AirPods parts and accessories',
            'parent_id' => $apple->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        // Specific iPhone models (is_device = true)
        Category::create([
            'name' => 'iPhone 15 Pro Max',
            'slug' => 'iphone-15-pro-max',
            'description' => 'iPhone 15 Pro Max parts',
            'parent_id' => $iphone->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        Category::create([
            'name' => 'iPhone 15 Pro',
            'slug' => 'iphone-15-pro',
            'description' => 'iPhone 15 Pro parts',
            'parent_id' => $iphone->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        Category::create([
            'name' => 'iPhone 15',
            'slug' => 'iphone-15',
            'description' => 'iPhone 15 parts',
            'parent_id' => $iphone->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        Category::create([
            'name' => 'iPhone 14 Pro Max',
            'slug' => 'iphone-14-pro-max',
            'description' => 'iPhone 14 Pro Max parts',
            'parent_id' => $iphone->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        Category::create([
            'name' => 'iPhone 14 Pro',
            'slug' => 'iphone-14-pro',
            'description' => 'iPhone 14 Pro parts',
            'parent_id' => $iphone->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        Category::create([
            'name' => 'iPhone 13',
            'slug' => 'iphone-13',
            'description' => 'iPhone 13 parts',
            'parent_id' => $iphone->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        Category::create([
            'name' => 'iPhone 12',
            'slug' => 'iphone-12',
            'description' => 'iPhone 12 parts',
            'parent_id' => $iphone->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        Category::create([
            'name' => 'iPhone 11',
            'slug' => 'iphone-11',
            'description' => 'iPhone 11 parts',
            'parent_id' => $iphone->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        // Samsung device subcategories
        $galaxyS = Category::create([
            'name' => 'Galaxy S Series',
            'slug' => 'galaxy-s-series',
            'description' => 'Samsung Galaxy S series parts',
            'parent_id' => $samsung->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        Category::create([
            'name' => 'Galaxy S24',
            'slug' => 'galaxy-s24',
            'description' => 'Samsung Galaxy S24 parts',
            'parent_id' => $galaxyS->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        Category::create([
            'name' => 'Galaxy S23',
            'slug' => 'galaxy-s23',
            'description' => 'Samsung Galaxy S23 parts',
            'parent_id' => $galaxyS->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        // Google Pixel subcategories
        Category::create([
            'name' => 'Pixel 8 Pro',
            'slug' => 'pixel-8-pro',
            'description' => 'Google Pixel 8 Pro parts',
            'parent_id' => $google->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        Category::create([
            'name' => 'Pixel 8',
            'slug' => 'pixel-8',
            'description' => 'Google Pixel 8 parts',
            'parent_id' => $google->id,
            'is_active' => true,
            'is_device' => true,
        ]);

        // Tools & Accessories subcategories (not devices)
        Category::create([
            'name' => 'Repair Tools',
            'slug' => 'repair-tools',
            'description' => 'Professional repair tools',
            'parent_id' => $tools->id,
            'is_active' => true,
            'is_device' => false,
        ]);

        Category::create([
            'name' => 'iFixit Tools',
            'slug' => 'ifixit-tools',
            'description' => 'iFixit professional tool kits',
            'parent_id' => $tools->id,
            'is_active' => true,
            'is_device' => false,
        ]);
    }
}
