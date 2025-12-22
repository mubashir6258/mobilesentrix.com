<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $iphone = Category::where('slug', 'iphone')->first();
        $ipad = Category::where('slug', 'ipad')->first();
        $samsung = Category::where('slug', 'samsung')->first();
        $google = Category::where('slug', 'google')->first();
        $repairTools = Category::where('slug', 'repair-tools')->first();
        $ifixitTools = Category::where('slug', 'ifixit-tools')->first();

        // iPhone Products
        Product::create([
            'category_id' => $iphone->id,
            'name' => 'iPhone 15 Pro Screen Replacement - OLED',
            'sku' => 'IP15PRO-SCR-OLED',
            'description' => 'Original quality OLED screen replacement for iPhone 15 Pro',
            'price' => 299.99,
            'cost' => 199.99,
            'stock_quantity' => 45,
            'low_stock_threshold' => 10,
            'is_active' => true,
            'is_featured' => true,
            'rating' => 4.8,
            'reviews_count' => 124,
        ]);

        Product::create([
            'category_id' => $iphone->id,
            'name' => 'iPhone 15 Battery - High Capacity',
            'sku' => 'IP15-BAT-HC',
            'description' => 'High capacity replacement battery for iPhone 15',
            'price' => 49.99,
            'cost' => 29.99,
            'stock_quantity' => 150,
            'low_stock_threshold' => 20,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.5,
            'reviews_count' => 89,
        ]);

        Product::create([
            'category_id' => $iphone->id,
            'name' => 'iPhone 14 Pro Max Screen - Premium',
            'sku' => 'IP14PM-SCR-PRM',
            'description' => 'Premium quality screen for iPhone 14 Pro Max',
            'price' => 279.99,
            'cost' => 189.99,
            'stock_quantity' => 62,
            'low_stock_threshold' => 15,
            'is_active' => true,
            'is_featured' => true,
            'rating' => 4.9,
            'reviews_count' => 201,
        ]);

        Product::create([
            'category_id' => $iphone->id,
            'name' => 'iPhone 13 Charging Port Flex Cable',
            'sku' => 'IP13-CHRG-FLX',
            'description' => 'Replacement charging port flex cable for iPhone 13',
            'price' => 24.99,
            'cost' => 14.99,
            'stock_quantity' => 8,
            'low_stock_threshold' => 10,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.3,
            'reviews_count' => 45,
        ]);

        Product::create([
            'category_id' => $iphone->id,
            'name' => 'iPhone 12 Back Glass - Black',
            'sku' => 'IP12-BG-BLK',
            'description' => 'Black back glass replacement for iPhone 12',
            'price' => 39.99,
            'cost' => 24.99,
            'stock_quantity' => 95,
            'low_stock_threshold' => 15,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.6,
            'reviews_count' => 67,
        ]);

        // iPad Products
        Product::create([
            'category_id' => $ipad->id,
            'name' => 'iPad Pro 12.9" Screen Assembly',
            'sku' => 'IPAD-PRO129-SCR',
            'description' => 'Complete screen assembly for iPad Pro 12.9"',
            'price' => 449.99,
            'cost' => 319.99,
            'stock_quantity' => 25,
            'low_stock_threshold' => 5,
            'is_active' => true,
            'is_featured' => true,
            'rating' => 4.7,
            'reviews_count' => 38,
        ]);

        Product::create([
            'category_id' => $ipad->id,
            'name' => 'iPad Air Battery Replacement',
            'sku' => 'IPAD-AIR-BAT',
            'description' => 'Replacement battery for iPad Air',
            'price' => 69.99,
            'cost' => 44.99,
            'stock_quantity' => 54,
            'low_stock_threshold' => 10,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.4,
            'reviews_count' => 29,
        ]);

        // Samsung Products
        Product::create([
            'category_id' => $samsung->id,
            'name' => 'Samsung Galaxy S24 AMOLED Screen',
            'sku' => 'SGS24-SCR-AMOLED',
            'description' => 'Original AMOLED screen for Samsung Galaxy S24',
            'price' => 259.99,
            'cost' => 179.99,
            'stock_quantity' => 38,
            'low_stock_threshold' => 10,
            'is_active' => true,
            'is_featured' => true,
            'rating' => 4.8,
            'reviews_count' => 92,
        ]);

        Product::create([
            'category_id' => $samsung->id,
            'name' => 'Galaxy S23 Battery - OEM Quality',
            'sku' => 'SGS23-BAT-OEM',
            'description' => 'OEM quality battery for Samsung Galaxy S23',
            'price' => 44.99,
            'cost' => 27.99,
            'stock_quantity' => 110,
            'low_stock_threshold' => 20,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.5,
            'reviews_count' => 73,
        ]);

        // Google Pixel Products
        Product::create([
            'category_id' => $google->id,
            'name' => 'Google Pixel 8 Pro Screen Assembly',
            'sku' => 'GPIX8P-SCR-ASM',
            'description' => 'Complete screen assembly for Google Pixel 8 Pro',
            'price' => 229.99,
            'cost' => 159.99,
            'stock_quantity' => 42,
            'low_stock_threshold' => 10,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.6,
            'reviews_count' => 51,
        ]);

        // Repair Tools
        Product::create([
            'category_id' => $repairTools->id,
            'name' => 'Professional Screwdriver Set - 32 Pieces',
            'sku' => 'TOOL-SCRW-32PC',
            'description' => 'Professional precision screwdriver set with 32 pieces',
            'price' => 29.99,
            'cost' => 15.99,
            'stock_quantity' => 200,
            'low_stock_threshold' => 30,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.7,
            'reviews_count' => 156,
        ]);

        Product::create([
            'category_id' => $repairTools->id,
            'name' => 'Opening Tool Set - 8 Pieces',
            'sku' => 'TOOL-OPEN-8PC',
            'description' => 'Professional opening tool set for mobile devices',
            'price' => 14.99,
            'cost' => 7.99,
            'stock_quantity' => 5,
            'low_stock_threshold' => 10,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.4,
            'reviews_count' => 98,
        ]);

        // iFixit Tools
        Product::create([
            'category_id' => $ifixitTools->id,
            'name' => 'iFixit Pro Tech Toolkit',
            'sku' => 'IFIXIT-PRO-KIT',
            'description' => 'Complete professional repair toolkit from iFixit',
            'price' => 79.99,
            'cost' => 52.99,
            'stock_quantity' => 75,
            'low_stock_threshold' => 15,
            'is_active' => true,
            'is_featured' => true,
            'rating' => 5.0,
            'reviews_count' => 342,
        ]);

        Product::create([
            'category_id' => $ifixitTools->id,
            'name' => 'iFixit Magnetic Mat - Repair Organization',
            'sku' => 'IFIXIT-MAG-MAT',
            'description' => 'Magnetic project mat for organizing screws and parts',
            'price' => 19.99,
            'cost' => 11.99,
            'stock_quantity' => 135,
            'low_stock_threshold' => 20,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.9,
            'reviews_count' => 178,
        ]);

        // Additional low stock items
        Product::create([
            'category_id' => $iphone->id,
            'name' => 'iPhone 11 Camera Lens',
            'sku' => 'IP11-CAM-LENS',
            'description' => 'Replacement camera lens for iPhone 11',
            'price' => 12.99,
            'cost' => 6.99,
            'stock_quantity' => 3,
            'low_stock_threshold' => 10,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.2,
            'reviews_count' => 32,
        ]);
    }
}
