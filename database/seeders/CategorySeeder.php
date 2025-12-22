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
        // Parent categories
        $apple = Category::create([
            'name' => 'Apple',
            'slug' => 'apple',
            'description' => 'Apple device parts and accessories',
            'is_active' => true,
        ]);

        $samsung = Category::create([
            'name' => 'Samsung',
            'slug' => 'samsung',
            'description' => 'Samsung device parts and accessories',
            'is_active' => true,
        ]);

        $google = Category::create([
            'name' => 'Google',
            'slug' => 'google',
            'description' => 'Google Pixel device parts',
            'is_active' => true,
        ]);

        $motorola = Category::create([
            'name' => 'Motorola',
            'slug' => 'motorola',
            'description' => 'Motorola device parts',
            'is_active' => true,
        ]);

        $lg = Category::create([
            'name' => 'LG',
            'slug' => 'lg',
            'description' => 'LG device parts',
            'is_active' => true,
        ]);

        $tools = Category::create([
            'name' => 'Tools & Accessories',
            'slug' => 'tools-accessories',
            'description' => 'Repair tools and accessories',
            'is_active' => true,
        ]);

        // Apple subcategories
        Category::create([
            'name' => 'iPhone',
            'slug' => 'iphone',
            'description' => 'iPhone parts and accessories',
            'parent_id' => $apple->id,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'iPad',
            'slug' => 'ipad',
            'description' => 'iPad parts and accessories',
            'parent_id' => $apple->id,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Mac',
            'slug' => 'mac',
            'description' => 'Mac parts and accessories',
            'parent_id' => $apple->id,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Apple Watch',
            'slug' => 'apple-watch',
            'description' => 'Apple Watch parts and accessories',
            'parent_id' => $apple->id,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'AirPods',
            'slug' => 'airpods',
            'description' => 'AirPods parts and accessories',
            'parent_id' => $apple->id,
            'is_active' => true,
        ]);

        // Tools & Accessories subcategories
        Category::create([
            'name' => 'Repair Tools',
            'slug' => 'repair-tools',
            'description' => 'Professional repair tools',
            'parent_id' => $tools->id,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'iFixit Tools',
            'slug' => 'ifixit-tools',
            'description' => 'iFixit professional tool kits',
            'parent_id' => $tools->id,
            'is_active' => true,
        ]);
    }
}
