<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPriceTier;
use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $iphone = Category::where('slug', 'iphone')->first();
        $iphone15Pro = Category::where('slug', 'iphone-15-pro')->first();
        $iphone15 = Category::where('slug', 'iphone-15')->first();
        $iphone14ProMax = Category::where('slug', 'iphone-14-pro-max')->first();
        $iphone13 = Category::where('slug', 'iphone-13')->first();
        $iphone12 = Category::where('slug', 'iphone-12')->first();
        $iphone11 = Category::where('slug', 'iphone-11')->first();
        $ipad = Category::where('slug', 'ipad')->first();
        $samsung = Category::where('slug', 'samsung')->first();
        $galaxyS24 = Category::where('slug', 'galaxy-s24')->first();
        $galaxyS23 = Category::where('slug', 'galaxy-s23')->first();
        $google = Category::where('slug', 'google')->first();
        $pixel8Pro = Category::where('slug', 'pixel-8-pro')->first();
        $repairTools = Category::where('slug', 'repair-tools')->first();
        $ifixitTools = Category::where('slug', 'ifixit-tools')->first();

        // Get brands
        $genuineOem = Brand::where('slug', 'genuine-oem')->first();
        $premiumAftermarket = Brand::where('slug', 'premium-aftermarket')->first();
        $standardAftermarket = Brand::where('slug', 'standard-aftermarket')->first();
        $ifixit = Brand::where('slug', 'ifixit')->first();
        $oemPull = Brand::where('slug', 'oem-pull-refurbished')->first();

        // Get product types
        $screenLcd = ProductType::where('slug', 'screen-lcd-assembly')->first();
        $oledAssembly = ProductType::where('slug', 'oled-assembly')->first();
        $battery = ProductType::where('slug', 'battery')->first();
        $chargingPort = ProductType::where('slug', 'charging-port-flex-cable')->first();
        $backGlass = ProductType::where('slug', 'back-glass-housing')->first();
        $cameraLens = ProductType::where('slug', 'camera-lens')->first();

        // iPhone Products
        $product1 = Product::create([
            'category_id' => $iphone->id,
            'brand_id' => $genuineOem->id,
            'product_type_id' => $oledAssembly->id,
            'name' => 'iPhone 15 Pro Screen Replacement - OLED',
            'sku' => 'IP15PRO-SCR-OLED',
            'description' => 'Original quality OLED screen replacement for iPhone 15 Pro. Features True Tone support and perfect color accuracy.',
            'price' => 299.99,
            'compare_price' => 349.99,
            'condition' => 'new',
            'warranty' => '1 Year Warranty',
            'weight' => 45.5,
            'dimensions' => ['length' => 15, 'width' => 8, 'height' => 1],
            'cost' => 199.99,
            'stock_quantity' => 45,
            'low_stock_threshold' => 10,
            'is_active' => true,
            'is_featured' => true,
            'rating' => 4.8,
            'reviews_count' => 124,
        ]);
        $this->createPriceTiers($product1, 299.99);
        $product1->compatibleCategories()->attach([$iphone15Pro->id]);

        $product2 = Product::create([
            'category_id' => $iphone->id,
            'brand_id' => $premiumAftermarket->id,
            'product_type_id' => $battery->id,
            'name' => 'iPhone 15 Battery - High Capacity',
            'sku' => 'IP15-BAT-HC',
            'description' => 'High capacity replacement battery for iPhone 15. Extended battery life with premium cells.',
            'price' => 49.99,
            'compare_price' => 59.99,
            'condition' => 'new',
            'warranty' => '6 Month Warranty',
            'weight' => 32.0,
            'dimensions' => ['length' => 10, 'width' => 5, 'height' => 0.5],
            'cost' => 29.99,
            'stock_quantity' => 150,
            'low_stock_threshold' => 20,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.5,
            'reviews_count' => 89,
        ]);
        $this->createPriceTiers($product2, 49.99);
        $product2->compatibleCategories()->attach([$iphone15->id]);

        $product3 = Product::create([
            'category_id' => $iphone->id,
            'brand_id' => $genuineOem->id,
            'product_type_id' => $oledAssembly->id,
            'name' => 'iPhone 14 Pro Max Screen - Premium',
            'sku' => 'IP14PM-SCR-PRM',
            'description' => 'Premium quality screen for iPhone 14 Pro Max. OLED display with original touch response.',
            'price' => 279.99,
            'compare_price' => 329.99,
            'condition' => 'new',
            'warranty' => '1 Year Warranty',
            'weight' => 52.0,
            'dimensions' => ['length' => 16, 'width' => 8, 'height' => 1],
            'cost' => 189.99,
            'stock_quantity' => 62,
            'low_stock_threshold' => 15,
            'is_active' => true,
            'is_featured' => true,
            'rating' => 4.9,
            'reviews_count' => 201,
        ]);
        $this->createPriceTiers($product3, 279.99);
        $product3->compatibleCategories()->attach([$iphone14ProMax->id]);

        $product4 = Product::create([
            'category_id' => $iphone->id,
            'brand_id' => $standardAftermarket->id,
            'product_type_id' => $chargingPort->id,
            'name' => 'iPhone 13 Charging Port Flex Cable',
            'sku' => 'IP13-CHRG-FLX',
            'description' => 'Replacement charging port flex cable for iPhone 13. Includes microphone and speaker components.',
            'price' => 24.99,
            'compare_price' => null,
            'condition' => 'new',
            'warranty' => '90 Day Warranty',
            'weight' => 5.0,
            'dimensions' => ['length' => 8, 'width' => 2, 'height' => 0.2],
            'cost' => 14.99,
            'stock_quantity' => 8,
            'low_stock_threshold' => 10,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.3,
            'reviews_count' => 45,
        ]);
        $this->createPriceTiers($product4, 24.99);
        $product4->compatibleCategories()->attach([$iphone13->id]);

        $product5 = Product::create([
            'category_id' => $iphone->id,
            'brand_id' => $premiumAftermarket->id,
            'product_type_id' => $backGlass->id,
            'name' => 'iPhone 12 Back Glass - Black',
            'sku' => 'IP12-BG-BLK',
            'description' => 'Black back glass replacement for iPhone 12. Perfect fit with adhesive included.',
            'price' => 39.99,
            'compare_price' => 49.99,
            'condition' => 'new',
            'warranty' => '6 Month Warranty',
            'weight' => 18.0,
            'dimensions' => ['length' => 14, 'width' => 7, 'height' => 0.3],
            'cost' => 24.99,
            'stock_quantity' => 95,
            'low_stock_threshold' => 15,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.6,
            'reviews_count' => 67,
        ]);
        $this->createPriceTiers($product5, 39.99);
        $product5->compatibleCategories()->attach([$iphone12->id]);

        // iPad Products
        $product6 = Product::create([
            'category_id' => $ipad->id,
            'brand_id' => $genuineOem->id,
            'product_type_id' => $screenLcd->id,
            'name' => 'iPad Pro 12.9" Screen Assembly',
            'sku' => 'IPAD-PRO129-SCR',
            'description' => 'Complete screen assembly for iPad Pro 12.9". Includes digitizer and LCD.',
            'price' => 449.99,
            'compare_price' => 549.99,
            'condition' => 'new',
            'warranty' => '1 Year Warranty',
            'weight' => 180.0,
            'dimensions' => ['length' => 32, 'width' => 22, 'height' => 1],
            'cost' => 319.99,
            'stock_quantity' => 25,
            'low_stock_threshold' => 5,
            'is_active' => true,
            'is_featured' => true,
            'rating' => 4.7,
            'reviews_count' => 38,
        ]);
        $this->createPriceTiers($product6, 449.99);

        $product7 = Product::create([
            'category_id' => $ipad->id,
            'brand_id' => $premiumAftermarket->id,
            'product_type_id' => $battery->id,
            'name' => 'iPad Air Battery Replacement',
            'sku' => 'IPAD-AIR-BAT',
            'description' => 'Replacement battery for iPad Air. High capacity with extended life.',
            'price' => 69.99,
            'compare_price' => null,
            'condition' => 'new',
            'warranty' => '6 Month Warranty',
            'weight' => 95.0,
            'dimensions' => ['length' => 15, 'width' => 10, 'height' => 0.5],
            'cost' => 44.99,
            'stock_quantity' => 54,
            'low_stock_threshold' => 10,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.4,
            'reviews_count' => 29,
        ]);
        $this->createPriceTiers($product7, 69.99);

        // Samsung Products
        $product8 = Product::create([
            'category_id' => $samsung->id,
            'brand_id' => $genuineOem->id,
            'product_type_id' => $oledAssembly->id,
            'name' => 'Samsung Galaxy S24 AMOLED Screen',
            'sku' => 'SGS24-SCR-AMOLED',
            'description' => 'Original AMOLED screen for Samsung Galaxy S24. Dynamic AMOLED 2X display.',
            'price' => 259.99,
            'compare_price' => 299.99,
            'condition' => 'new',
            'warranty' => '1 Year Warranty',
            'weight' => 42.0,
            'dimensions' => ['length' => 15, 'width' => 7, 'height' => 1],
            'cost' => 179.99,
            'stock_quantity' => 38,
            'low_stock_threshold' => 10,
            'is_active' => true,
            'is_featured' => true,
            'rating' => 4.8,
            'reviews_count' => 92,
        ]);
        $this->createPriceTiers($product8, 259.99);
        if ($galaxyS24) {
            $product8->compatibleCategories()->attach([$galaxyS24->id]);
        }

        $product9 = Product::create([
            'category_id' => $samsung->id,
            'brand_id' => $oemPull->id,
            'product_type_id' => $battery->id,
            'name' => 'Galaxy S23 Battery - OEM Quality',
            'sku' => 'SGS23-BAT-OEM',
            'description' => 'OEM quality battery for Samsung Galaxy S23. Professionally refurbished.',
            'price' => 44.99,
            'compare_price' => 59.99,
            'condition' => 'refurbished',
            'warranty' => '90 Day Warranty',
            'weight' => 28.0,
            'dimensions' => ['length' => 9, 'width' => 5, 'height' => 0.4],
            'cost' => 27.99,
            'stock_quantity' => 110,
            'low_stock_threshold' => 20,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.5,
            'reviews_count' => 73,
        ]);
        $this->createPriceTiers($product9, 44.99);
        if ($galaxyS23) {
            $product9->compatibleCategories()->attach([$galaxyS23->id]);
        }

        // Google Pixel Products
        $product10 = Product::create([
            'category_id' => $google->id,
            'brand_id' => $premiumAftermarket->id,
            'product_type_id' => $screenLcd->id,
            'name' => 'Google Pixel 8 Pro Screen Assembly',
            'sku' => 'GPIX8P-SCR-ASM',
            'description' => 'Complete screen assembly for Google Pixel 8 Pro. LTPO OLED display.',
            'price' => 229.99,
            'compare_price' => 279.99,
            'condition' => 'new',
            'warranty' => '1 Year Warranty',
            'weight' => 48.0,
            'dimensions' => ['length' => 16, 'width' => 8, 'height' => 1],
            'cost' => 159.99,
            'stock_quantity' => 42,
            'low_stock_threshold' => 10,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.6,
            'reviews_count' => 51,
        ]);
        $this->createPriceTiers($product10, 229.99);
        if ($pixel8Pro) {
            $product10->compatibleCategories()->attach([$pixel8Pro->id]);
        }

        // Repair Tools
        Product::create([
            'category_id' => $repairTools->id,
            'brand_id' => $standardAftermarket->id,
            'product_type_id' => null,
            'name' => 'Professional Screwdriver Set - 32 Pieces',
            'sku' => 'TOOL-SCRW-32PC',
            'description' => 'Professional precision screwdriver set with 32 pieces. Includes all common smartphone bits.',
            'price' => 29.99,
            'compare_price' => 39.99,
            'condition' => 'new',
            'warranty' => 'Lifetime Warranty',
            'weight' => 250.0,
            'dimensions' => ['length' => 20, 'width' => 12, 'height' => 4],
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
            'brand_id' => $standardAftermarket->id,
            'product_type_id' => null,
            'name' => 'Opening Tool Set - 8 Pieces',
            'sku' => 'TOOL-OPEN-8PC',
            'description' => 'Professional opening tool set for mobile devices. Safe plastic pry tools.',
            'price' => 14.99,
            'compare_price' => null,
            'condition' => 'new',
            'warranty' => '1 Year Warranty',
            'weight' => 85.0,
            'dimensions' => ['length' => 15, 'width' => 10, 'height' => 2],
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
            'brand_id' => $ifixit->id,
            'product_type_id' => null,
            'name' => 'iFixit Pro Tech Toolkit',
            'sku' => 'IFIXIT-PRO-KIT',
            'description' => 'Complete professional repair toolkit from iFixit. 64 precision bits and essential tools.',
            'price' => 79.99,
            'compare_price' => 99.99,
            'condition' => 'new',
            'warranty' => 'Lifetime Warranty',
            'weight' => 680.0,
            'dimensions' => ['length' => 25, 'width' => 15, 'height' => 5],
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
            'brand_id' => $ifixit->id,
            'product_type_id' => null,
            'name' => 'iFixit Magnetic Mat - Repair Organization',
            'sku' => 'IFIXIT-MAG-MAT',
            'description' => 'Magnetic project mat for organizing screws and parts. Essential for complex repairs.',
            'price' => 19.99,
            'compare_price' => 24.99,
            'condition' => 'new',
            'warranty' => 'Lifetime Warranty',
            'weight' => 320.0,
            'dimensions' => ['length' => 30, 'width' => 20, 'height' => 0.5],
            'cost' => 11.99,
            'stock_quantity' => 135,
            'low_stock_threshold' => 20,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.9,
            'reviews_count' => 178,
        ]);

        // Additional low stock item
        $product15 = Product::create([
            'category_id' => $iphone->id,
            'brand_id' => $standardAftermarket->id,
            'product_type_id' => $cameraLens->id,
            'name' => 'iPhone 11 Camera Lens',
            'sku' => 'IP11-CAM-LENS',
            'description' => 'Replacement camera lens for iPhone 11. Includes adhesive for easy installation.',
            'price' => 12.99,
            'compare_price' => null,
            'condition' => 'new',
            'warranty' => '90 Day Warranty',
            'weight' => 2.0,
            'dimensions' => ['length' => 3, 'width' => 3, 'height' => 0.2],
            'cost' => 6.99,
            'stock_quantity' => 3,
            'low_stock_threshold' => 10,
            'is_active' => true,
            'is_featured' => false,
            'rating' => 4.2,
            'reviews_count' => 32,
        ]);
        $this->createPriceTiers($product15, 12.99);
        $product15->compatibleCategories()->attach([$iphone11->id]);
    }

    /**
     * Create price tiers for a product.
     */
    private function createPriceTiers(Product $product, float $basePrice): void
    {
        // Tier 1: 1-9 units (base price)
        ProductPriceTier::create([
            'product_id' => $product->id,
            'min_quantity' => 1,
            'max_quantity' => 9,
            'price' => $basePrice,
        ]);

        // Tier 2: 10-24 units (~5% off)
        ProductPriceTier::create([
            'product_id' => $product->id,
            'min_quantity' => 10,
            'max_quantity' => 24,
            'price' => round($basePrice * 0.95, 2),
        ]);

        // Tier 3: 25-49 units (~10% off)
        ProductPriceTier::create([
            'product_id' => $product->id,
            'min_quantity' => 25,
            'max_quantity' => 49,
            'price' => round($basePrice * 0.90, 2),
        ]);

        // Tier 4: 50+ units (~15% off)
        ProductPriceTier::create([
            'product_id' => $product->id,
            'min_quantity' => 50,
            'max_quantity' => null,
            'price' => round($basePrice * 0.85, 2),
        ]);
    }
}
