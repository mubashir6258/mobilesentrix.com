@extends('adminlte::page')

@section('title', 'Product Details - MobileSentrix Admin')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Product Details</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning float-right">
                <i class="fas fa-edit"></i> Edit Product
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Product Information</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px;">Product Name</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>SKU</th>
                            <td><code>{{ $product->sku }}</code></td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td><code>{{ $product->slug }}</code></td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td><span class="badge badge-info">{{ $product->category->name }}</span></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $product->description ?: 'No description' }}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td><strong>${{ number_format($product->price, 2) }}</strong></td>
                        </tr>
                        <tr>
                            <th>Cost</th>
                            <td>{{ $product->cost ? '$' . number_format($product->cost, 2) : 'Not set' }}</td>
                        </tr>
                        <tr>
                            <th>Profit Margin</th>
                            <td>
                                @if($product->cost)
                                    ${{ number_format($product->price - $product->cost, 2) }}
                                    ({{ number_format((($product->price - $product->cost) / $product->price) * 100, 1) }}%)
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Stock Quantity</th>
                            <td>
                                @if($product->isLowStock())
                                    <span class="badge badge-danger">{{ $product->stock_quantity }} (Low Stock)</span>
                                @elseif($product->stock_quantity == 0)
                                    <span class="badge badge-dark">Out of Stock</span>
                                @else
                                    <span class="badge badge-success">{{ $product->stock_quantity }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Low Stock Threshold</th>
                            <td>{{ $product->low_stock_threshold }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($product->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Featured</th>
                            <td>
                                @if($product->is_featured)
                                    <span class="badge badge-warning">Yes</span>
                                @else
                                    <span class="badge badge-secondary">No</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Rating</th>
                            <td>{{ $product->rating }}/5 ({{ $product->reviews_count }} reviews)</td>
                        </tr>
                        <tr>
                            <th>Created</th>
                            <td>{{ $product->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>{{ $product->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Product Images</h3>
                </div>
                <div class="card-body">
                    @if($product->image)
                        <div class="mb-3">
                            <label>Main Image:</label><br>
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                        </div>
                    @else
                        <p class="text-muted">No main image</p>
                    @endif

                    @if($product->images && count($product->images) > 0)
                        <div class="mt-3">
                            <label>Additional Images:</label><br>
                            <div class="row">
                                @foreach($product->images as $img)
                                    <div class="col-6 mb-2">
                                        <img src="{{ asset('storage/' . $img) }}" alt="{{ $product->name }}" class="img-fluid">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Actions</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-block">
                        <i class="fas fa-edit"></i> Edit Product
                    </a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block">
                            <i class="fas fa-trash"></i> Delete Product
                        </button>
                    </form>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-arrow-left"></i> Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
