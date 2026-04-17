@extends('adminlte::page')

@section('title', 'Brand Details - MobileSentrix Admin')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Brand: {{ $brand->name }}</h1>
        <div>
            <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Brand Information</h3>
                </div>
                <div class="card-body">
                    @if($brand->image)
                        <div class="text-center mb-3">
                            <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}" class="img-fluid" style="max-height: 200px;">
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <tr>
                            <th width="100">ID</th>
                            <td>{{ $brand->id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $brand->name }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td><code>{{ $brand->slug }}</code></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($brand->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Products</th>
                            <td><span class="badge badge-info">{{ $brand->products->count() }}</span></td>
                        </tr>
                        <tr>
                            <th>Created</th>
                            <td>{{ $brand->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Updated</th>
                            <td>{{ $brand->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </table>

                    @if($brand->description)
                        <h5 class="mt-3">Description</h5>
                        <p>{{ $brand->description }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Products with this Brand ({{ $brand->products->count() }})</h3>
                </div>
                <div class="card-body">
                    @if($brand->products->count() > 0)
                        <table class="table table-bordered table-striped" id="products-table">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brand->products as $product)
                                    <tr>
                                        <td><code>{{ $product->sku }}</code></td>
                                        <td>{{ $product->name }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>
                                            @if($product->stock_quantity <= $product->low_stock_threshold)
                                                <span class="badge badge-warning">{{ $product->stock_quantity }}</span>
                                            @else
                                                <span class="badge badge-success">{{ $product->stock_quantity }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No products associated with this brand.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#products-table').DataTable();
    });
</script>
@stop
