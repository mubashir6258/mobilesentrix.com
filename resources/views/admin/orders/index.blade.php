@extends('adminlte::page')

@section('title', 'Orders - MobileSentrix Admin')

@section('content_header')
    <h1>Orders</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Filter Orders</h3>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.orders.index') }}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" name="search" class="form-control" placeholder="Search order #, customer..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option value="">All Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="date" name="from_date" class="form-control" placeholder="From Date" value="{{ request('from_date') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="date" name="to_date" class="form-control" placeholder="To Date" value="{{ request('to_date') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Filter</button>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary"><i class="fas fa-redo"></i> Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="ordersTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td><code>{{ $order->order_number }}</code></td>
                            <td>
                                <strong>{{ $order->customer_name }}</strong><br>
                                <small class="text-muted">{{ $order->customer_email }}</small>
                            </td>
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
                            <td colspan="7" class="text-center">No orders found</td>
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
            "order": [[2, 'desc']]  // Sort by date descending
        });
    });
</script>
@stop
