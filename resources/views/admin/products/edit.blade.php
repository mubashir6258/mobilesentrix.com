@extends('adminlte::page')

@section('title', 'Edit Product - MobileSentrix Admin')

@section('content_header')
    <h1>Edit Product: {{ $product->name }}</h1>
@stop

@section('content')
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Product Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sku">SKU <span class="text-danger">*</span></label>
                                    <input type="text" name="sku" id="sku" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku', $product->sku) }}" required>
                                    @error('sku')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $product->slug) }}">
                                    @error('slug')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="price">Price <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" name="price" id="price" step="0.01" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" required>
                                        @error('price')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="compare_price">Compare Price</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" name="compare_price" id="compare_price" step="0.01" class="form-control @error('compare_price') is-invalid @enderror" value="{{ old('compare_price', $product->compare_price) }}">
                                        @error('compare_price')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <small class="form-text text-muted">Original price to show discount</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cost">Cost</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" name="cost" id="cost" step="0.01" class="form-control @error('cost') is-invalid @enderror" value="{{ old('cost', $product->cost) }}">
                                        @error('cost')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Price Tiers (Volume Pricing)</h3>
                    </div>
                    <div class="card-body">
                        <div id="price-tiers">
                            @forelse($product->priceTiers as $index => $tier)
                                <div class="price-tier row mb-2">
                                    <div class="col-md-3">
                                        <input type="number" name="price_tiers[{{ $index }}][min_quantity]" class="form-control" placeholder="Min Qty" value="{{ $tier->min_quantity }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="price_tiers[{{ $index }}][max_quantity]" class="form-control" placeholder="Max Qty" value="{{ $tier->max_quantity }}">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" name="price_tiers[{{ $index }}][price]" step="0.01" class="form-control" placeholder="Price" value="{{ $tier->price }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-block remove-tier" {{ $index == 0 ? 'disabled' : '' }}>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="price-tier row mb-2">
                                    <div class="col-md-3">
                                        <input type="number" name="price_tiers[0][min_quantity]" class="form-control" placeholder="Min Qty" value="1">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="price_tiers[0][max_quantity]" class="form-control" placeholder="Max Qty">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" name="price_tiers[0][price]" step="0.01" class="form-control" placeholder="Price">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-block remove-tier" disabled>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm mt-2" id="add-tier">
                            <i class="fas fa-plus"></i> Add Tier
                        </button>
                        <small class="form-text text-muted">Leave empty to use single base price. Add multiple tiers for volume discounts.</small>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Additional Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="condition">Condition</label>
                                    <select name="condition" id="condition" class="form-control @error('condition') is-invalid @enderror">
                                        <option value="new" {{ old('condition', $product->condition) == 'new' ? 'selected' : '' }}>New</option>
                                        <option value="refurbished" {{ old('condition', $product->condition) == 'refurbished' ? 'selected' : '' }}>Refurbished</option>
                                        <option value="used" {{ old('condition', $product->condition) == 'used' ? 'selected' : '' }}>Used</option>
                                    </select>
                                    @error('condition')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="warranty">Warranty</label>
                                    <input type="text" name="warranty" id="warranty" class="form-control @error('warranty') is-invalid @enderror" value="{{ old('warranty', $product->warranty) }}" placeholder="e.g., 1 Year Warranty">
                                    @error('warranty')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="weight">Weight (grams)</label>
                                    <input type="number" name="weight" id="weight" step="0.01" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight', $product->weight) }}">
                                    @error('weight')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dimensions_length">Length (cm)</label>
                                    <input type="number" name="dimensions[length]" id="dimensions_length" step="0.1" class="form-control" value="{{ old('dimensions.length', $product->dimensions['length'] ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dimensions_width">Width (cm)</label>
                                    <input type="number" name="dimensions[width]" id="dimensions_width" step="0.1" class="form-control" value="{{ old('dimensions.width', $product->dimensions['width'] ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dimensions_height">Height (cm)</label>
                                    <input type="number" name="dimensions[height]" id="dimensions_height" step="0.1" class="form-control" value="{{ old('dimensions.height', $product->dimensions['height'] ?? '') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Classification</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="category_id">Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="brand_id">Brand</label>
                            <select name="brand_id" id="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="product_type_id">Product Type</label>
                            <select name="product_type_id" id="product_type_id" class="form-control @error('product_type_id') is-invalid @enderror">
                                <option value="">Select Product Type</option>
                                @foreach($productTypes as $productType)
                                    <option value="{{ $productType->id }}" {{ old('product_type_id', $product->product_type_id) == $productType->id ? 'selected' : '' }}>
                                        {{ $productType->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_type_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="compatible_devices">Compatible Devices</label>
                            <select name="compatible_devices[]" id="compatible_devices" class="form-control select2 @error('compatible_devices') is-invalid @enderror" multiple>
                                @foreach($deviceCategories as $device)
                                    <option value="{{ $device->id }}" {{ in_array($device->id, old('compatible_devices', $product->compatibleCategories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $device->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('compatible_devices')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted">Select devices this product is compatible with</small>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Inventory</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="stock_quantity">Stock Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="stock_quantity" id="stock_quantity" class="form-control @error('stock_quantity') is-invalid @enderror" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                            @error('stock_quantity')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="low_stock_threshold">Low Stock Threshold</label>
                            <input type="number" name="low_stock_threshold" id="low_stock_threshold" class="form-control @error('low_stock_threshold') is-invalid @enderror" value="{{ old('low_stock_threshold', $product->low_stock_threshold) }}">
                            @error('low_stock_threshold')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Active</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="is_featured" class="custom-control-input" id="is_featured" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_featured">Featured</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Product Images</h3>
                    </div>
                    <div class="card-body">
                        @if($product->image)
                            <div class="mb-3">
                                <label>Current Main Image:</label><br>
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 100%; max-height: 200px;">
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="image">Main Image</label>
                            <div class="custom-file">
                                <input type="file" name="image" id="image" class="custom-file-input @error('image') is-invalid @enderror" accept="image/*">
                                <label class="custom-file-label" for="image">Choose file</label>
                                @error('image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <small class="form-text text-muted">Leave empty to keep current image</small>
                        </div>

                        @if($product->images && count($product->images) > 0)
                            <div class="mb-3">
                                <label>Current Additional Images:</label><br>
                                <div class="row">
                                    @foreach($product->images as $img)
                                        <div class="col-6 mb-2">
                                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $product->name }}" style="max-width: 100%; max-height: 100px;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="images">Additional Images</label>
                            <div class="custom-file">
                                <input type="file" name="images[]" id="images" class="custom-file-input" accept="image/*" multiple>
                                <label class="custom-file-label" for="images">Choose files</label>
                            </div>
                            <small class="form-text text-muted">Leave empty to keep current images</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Product
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </div>
    </form>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap4-theme@1.0.0/dist/select2-bootstrap4.min.css" rel="stylesheet" />
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: 'Select compatible devices'
        });
    });

    document.querySelector('#image').addEventListener('change', function(e) {
        var fileName = e.target.files[0] ? e.target.files[0].name : 'Choose file';
        e.target.nextElementSibling.textContent = fileName;
    });

    document.querySelector('#images').addEventListener('change', function(e) {
        var fileCount = e.target.files.length;
        var label = fileCount + ' file(s) selected';
        e.target.nextElementSibling.textContent = label;
    });

    // Price tiers management
    let tierIndex = {{ $product->priceTiers->count() ?: 1 }};
    document.getElementById('add-tier').addEventListener('click', function() {
        const tiersContainer = document.getElementById('price-tiers');
        const tierHtml = `
            <div class="price-tier row mb-2">
                <div class="col-md-3">
                    <input type="number" name="price_tiers[${tierIndex}][min_quantity]" class="form-control" placeholder="Min Qty">
                </div>
                <div class="col-md-3">
                    <input type="number" name="price_tiers[${tierIndex}][max_quantity]" class="form-control" placeholder="Max Qty">
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" name="price_tiers[${tierIndex}][price]" step="0.01" class="form-control" placeholder="Price">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-block remove-tier">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
        tiersContainer.insertAdjacentHTML('beforeend', tierHtml);
        tierIndex++;
    });

    document.getElementById('price-tiers').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-tier') || e.target.closest('.remove-tier')) {
            const tier = e.target.closest('.price-tier');
            if (document.querySelectorAll('.price-tier').length > 1) {
                tier.remove();
            }
        }
    });
</script>
@stop
