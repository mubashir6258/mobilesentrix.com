@extends('adminlte::page')

@section('title', 'Customer Details - MobileSentrix Admin')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Customer Details</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary float-right">
                <i class="fas fa-arrow-left"></i> Back to Customers
            </a>
            <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-warning float-right mr-2">
                <i class="fas fa-edit"></i> Edit Customer
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <div class="profile-user-img img-fluid img-circle bg-primary d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px; font-size: 48px; color: white;">
                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                        </div>
                    </div>

                    <h3 class="profile-username text-center">{{ $customer->name }}</h3>

                    <p class="text-muted text-center">{{ $customer->email }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Customer ID</b> <a class="float-right">{{ $customer->id }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Registered</b> <a class="float-right">{{ $customer->created_at->format('M d, Y') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Member Since</b> <a class="float-right">{{ $customer->created_at->diffForHumans() }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="row">
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $stats['total_orders'] }}</h3>
                            <p>Total Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>${{ number_format($stats['total_spent'], 2) }}</h3>
                            <p>Total Spent</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $stats['pending_orders'] }}</h3>
                            <p>Pending Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $stats['completed_orders'] }}</h3>
                            <p>Completed Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Order History</h3>
        </div>
        <div class="card-body">
            <table id="ordersTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customer->orders as $order)
                        <tr>
                            <td><code>{{ $order->order_number }}</code></td>
                            <td>{{ $order->created_at->format('M d, Y') }}<br><small class="text-muted">{{ $order->created_at->format('h:i A') }}</small></td>
                            <td>{{ $order->orderItems->count() }} items</td>
                            <td><strong>${{ number_format($order->total, 2) }}</strong></td>
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
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No orders found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#ordersTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "order": [[1, 'desc']]  // Sort by date descending
        });
    });
</script>
@stop
