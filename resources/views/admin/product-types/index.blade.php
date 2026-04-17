@extends('adminlte::page')

@section('title', 'Product Types - MobileSentrix Admin')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Product Types</h1>
        <a href="{{ route('admin.product-types.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Product Type
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped" id="product-types-table">
                <thead>
                    <tr>
                        <th width="60">ID</th>
                        <th width="80">Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th width="100">Products</th>
                        <th width="80">Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productTypes as $productType)
                        <tr>
                            <td>{{ $productType->id }}</td>
                            <td>
                                @if($productType->image)
                                    <img src="{{ asset('storage/' . $productType->image) }}" alt="{{ $productType->name }}" style="max-width: 50px; max-height: 50px;">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>{{ $productType->name }}</td>
                            <td><code>{{ $productType->slug }}</code></td>
                            <td>
                                <span class="badge badge-info">{{ $productType->products_count }}</span>
                            </td>
                            <td>
                                @if($productType->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.product-types.show', $productType) }}" class="btn btn-sm btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.product-types.edit', $productType) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.product-types.destroy', $productType) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product type?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#product-types-table').DataTable({
            "order": [[0, "asc"]]
        });
    });
</script>
@stop
