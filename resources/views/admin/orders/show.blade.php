@extends('adminlte::page')

@section('title', 'Order Details - MobileSentrix Admin')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Order Details: {{ $order->order_number }}</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary float-right">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
        </div>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Order Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <th>Order Number:</th>
                                    <td><code>{{ $order->order_number }}</code></td>
                                </tr>
                                <tr>
                                    <th>Customer:</th>
                                    <td>{{ $order->customer_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $order->customer_email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td>{{ $order->customer_phone ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Order Date:</th>
                                    <td>{{ $order->created_at->format('M d, Y H:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <th>Payment Method:</th>
                                    <td>{{ $order->payment_method ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @php
                                            $badgeClass = match($order->status) {
                                                'completed' => 'badge-success',
                                                'pending' => 'badge-warning',
                                                'processing' => 'badge-info',
                                                'cancelled' => 'badge-danger',
                                                'refunded' => 'badge-secondary',
                                                default => 'badge-light',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ ucfirst($order->status) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Notes:</th>
                                    <td>{{ $order->notes ?? 'No notes' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Order Items</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td>
                                        {{ $item->product_name }}
                                        @if($item->product)
                                            <br><small class="text-muted">
                                                <a href="{{ route('admin.products.show', $item->product) }}" target="_blank">
                                                    View Product
                                                </a>
                                            </small>
                                        @endif
                                    </td>
                                    <td><code>{{ $item->product_sku }}</code></td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td><strong>${{ number_format($item->subtotal, 2) }}</strong></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                                <td><strong>${{ number_format($order->subtotal, 2) }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right"><strong>Tax:</strong></td>
                                <td>${{ number_format($order->tax, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right"><strong>Shipping:</strong></td>
                                <td>${{ number_format($order->shipping, 2) }}</td>
                            </tr>
                            <tr class="table-primary">
                                <td colspan="4" class="text-right"><strong>Total:</strong></td>
                                <td><strong>${{ number_format($order->total, 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Shipping Address</h3>
                        </div>
                        <div class="card-body">
                            @if($order->shipping_address)
                                <address>{!! nl2br(e($order->shipping_address)) !!}</address>
                            @else
                                <p class="text-muted">No shipping address provided</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Billing Address</h3>
                        </div>
                        <div class="card-body">
                            @if($order->billing_address)
                                <address>{!! nl2br(e($order->billing_address)) !!}</address>
                            @else
                                <p class="text-muted">No billing address provided</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Order Status</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="refunded" {{ $order->status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Order Summary</h3>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th>Items:</th>
                            <td>{{ $order->orderItems->count() }}</td>
                        </tr>
                        <tr>
                            <th>Subtotal:</th>
                            <td>${{ number_format($order->subtotal, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Tax:</th>
                            <td>${{ number_format($order->tax, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Shipping:</th>
                            <td>${{ number_format($order->shipping, 2) }}</td>
                        </tr>
                        <tr class="font-weight-bold">
                            <th>Total:</th>
                            <td>${{ number_format($order->total, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
