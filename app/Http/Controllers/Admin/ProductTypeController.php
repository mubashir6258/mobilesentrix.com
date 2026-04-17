<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductTypeController extends Controller
{
    public function index()
    {
        $productTypes = ProductType::withCount('products')->get();
        return view('admin.product-types.index', compact('productTypes'));
    }

    public function create()
    {
        return view('admin.product-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:product_types,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('product-types', 'public');
        }

        ProductType::create($validated);

        return redirect()->route('admin.product-types.index')->with('success', 'Product Type created successfully!');
    }

    public function show(ProductType $productType)
    {
        $productType->load('products');
        return view('admin.product-types.show', compact('productType'));
    }

    public function edit(ProductType $productType)
    {
        return view('admin.product-types.edit', compact('productType'));
    }

    public function update(Request $request, ProductType $productType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:product_types,slug,' . $productType->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($productType->image) {
                Storage::disk('public')->delete($productType->image);
            }
            $validated['image'] = $request->file('image')->store('product-types', 'public');
        }

        $productType->update($validated);

        return redirect()->route('admin.product-types.index')->with('success', 'Product Type updated successfully!');
    }

    public function destroy(ProductType $productType)
    {
        if ($productType->products()->count() > 0) {
            return redirect()->route('admin.product-types.index')
                ->with('error', 'Cannot delete product type with associated products. Please reassign or delete products first.');
        }

        if ($productType->image) {
            Storage::disk('public')->delete($productType->image);
        }

        $productType->delete();

        return redirect()->route('admin.product-types.index')->with('success', 'Product Type deleted successfully!');
    }
}
