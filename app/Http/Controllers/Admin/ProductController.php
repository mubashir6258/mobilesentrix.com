<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPriceTier;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand', 'productType']);

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by brand
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        // Filter by product type
        if ($request->filled('product_type_id')) {
            $query->where('product_type_id', $request->product_type_id);
        }

        // Filter by stock status
        if ($request->filled('stock_status')) {
            if ($request->stock_status === 'low') {
                $query->whereColumn('stock_quantity', '<=', 'low_stock_threshold');
            } elseif ($request->stock_status === 'in_stock') {
                $query->whereColumn('stock_quantity', '>', 'low_stock_threshold');
            } elseif ($request->stock_status === 'out_of_stock') {
                $query->where('stock_quantity', 0);
            }
        }

        // Filter by condition
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $query->get();
        $categories = Category::all();
        $brands = Brand::where('is_active', true)->get();
        $productTypes = ProductType::where('is_active', true)->get();

        return view('admin.products.index', compact('products', 'categories', 'brands', 'productTypes'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::where('is_active', true)->get();
        $productTypes = ProductType::where('is_active', true)->get();
        $deviceCategories = Category::where('is_device', true)->get();

        return view('admin.products.create', compact('categories', 'brands', 'productTypes', 'deviceCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'product_type_id' => 'nullable|exists:product_types,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:products,slug',
            'sku' => 'required|string|unique:products,sku',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'cost' => 'nullable|numeric|min:0',
            'condition' => 'nullable|in:new,refurbished,used',
            'warranty' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|array',
            'dimensions.length' => 'nullable|numeric|min:0',
            'dimensions.width' => 'nullable|numeric|min:0',
            'dimensions.height' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'compatible_devices' => 'nullable|array',
            'compatible_devices.*' => 'exists:categories,id',
            'price_tiers' => 'nullable|array',
            'price_tiers.*.min_quantity' => 'nullable|integer|min:1',
            'price_tiers.*.max_quantity' => 'nullable|integer|min:1',
            'price_tiers.*.price' => 'nullable|numeric|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['low_stock_threshold'] = $validated['low_stock_threshold'] ?? 10;
        $validated['condition'] = $validated['condition'] ?? 'new';

        // Handle dimensions
        if (isset($validated['dimensions'])) {
            $dimensions = array_filter($validated['dimensions'], fn($v) => $v !== null && $v !== '');
            $validated['dimensions'] = !empty($dimensions) ? $dimensions : null;
        }

        // Handle main image
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Handle multiple images
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('products', 'public');
            }
            $validated['images'] = $images;
        }

        // Remove non-product fields before creating
        $compatibleDevices = $validated['compatible_devices'] ?? [];
        $priceTiers = $validated['price_tiers'] ?? [];
        unset($validated['compatible_devices'], $validated['price_tiers']);

        $product = Product::create($validated);

        // Attach compatible devices
        if (!empty($compatibleDevices)) {
            $product->compatibleCategories()->attach($compatibleDevices);
        }

        // Create price tiers
        $this->savePriceTiers($product, $priceTiers);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'productType', 'priceTiers', 'compatibleCategories', 'orderItems']);
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::where('is_active', true)->get();
        $productTypes = ProductType::where('is_active', true)->get();
        $deviceCategories = Category::where('is_device', true)->get();
        $product->load(['priceTiers', 'compatibleCategories']);

        return view('admin.products.edit', compact('product', 'categories', 'brands', 'productTypes', 'deviceCategories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'product_type_id' => 'nullable|exists:product_types,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:products,slug,' . $product->id,
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'cost' => 'nullable|numeric|min:0',
            'condition' => 'nullable|in:new,refurbished,used',
            'warranty' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|array',
            'dimensions.length' => 'nullable|numeric|min:0',
            'dimensions.width' => 'nullable|numeric|min:0',
            'dimensions.height' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'compatible_devices' => 'nullable|array',
            'compatible_devices.*' => 'exists:categories,id',
            'price_tiers' => 'nullable|array',
            'price_tiers.*.min_quantity' => 'nullable|integer|min:1',
            'price_tiers.*.max_quantity' => 'nullable|integer|min:1',
            'price_tiers.*.price' => 'nullable|numeric|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        // Handle dimensions
        if (isset($validated['dimensions'])) {
            $dimensions = array_filter($validated['dimensions'], fn($v) => $v !== null && $v !== '');
            $validated['dimensions'] = !empty($dimensions) ? $dimensions : null;
        }

        // Handle main image
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Handle multiple images
        if ($request->hasFile('images')) {
            // Delete old images
            if ($product->images) {
                foreach ($product->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('products', 'public');
            }
            $validated['images'] = $images;
        }

        // Remove non-product fields before updating
        $compatibleDevices = $validated['compatible_devices'] ?? [];
        $priceTiers = $validated['price_tiers'] ?? [];
        unset($validated['compatible_devices'], $validated['price_tiers']);

        $product->update($validated);

        // Sync compatible devices
        $product->compatibleCategories()->sync($compatibleDevices);

        // Update price tiers
        $this->savePriceTiers($product, $priceTiers);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Delete images
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        // Delete related price tiers
        $product->priceTiers()->delete();

        // Detach compatible devices
        $product->compatibleCategories()->detach();

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    /**
     * Save price tiers for a product.
     */
    private function savePriceTiers(Product $product, array $tiers): void
    {
        // Delete existing tiers
        $product->priceTiers()->delete();

        // Create new tiers
        foreach ($tiers as $tier) {
            // Skip if no min_quantity or price provided
            if (empty($tier['min_quantity']) || empty($tier['price'])) {
                continue;
            }

            ProductPriceTier::create([
                'product_id' => $product->id,
                'min_quantity' => $tier['min_quantity'],
                'max_quantity' => $tier['max_quantity'] ?: null,
                'price' => $tier['price'],
            ]);
        }
    }
}
