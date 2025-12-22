<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'customer')->withCount('orders');

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by registration date
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $customers = $query->latest()->get();

        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer)
    {
        // Ensure we're only showing customers, not admins
        if ($customer->role !== 'customer') {
            abort(403, 'Unauthorized access.');
        }

        $customer->load(['orders' => function($query) {
            $query->latest();
        }]);

        $stats = [
            'total_orders' => $customer->orders->count(),
            'total_spent' => $customer->orders->where('status', 'completed')->sum('total'),
            'pending_orders' => $customer->orders->where('status', 'pending')->count(),
            'completed_orders' => $customer->orders->where('status', 'completed')->count(),
        ];

        return view('admin.customers.show', compact('customer', 'stats'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'customer',
        ]);

        return redirect()->route('admin.customers.index')->with('success', 'Customer created successfully!');
    }

    public function edit(User $customer)
    {
        // Ensure we're only editing customers, not admins
        if ($customer->role !== 'customer') {
            abort(403, 'Unauthorized access.');
        }

        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, User $customer)
    {
        // Ensure we're only updating customers, not admins
        if ($customer->role !== 'customer') {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $customer->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $customer->name = $validated['name'];
        $customer->email = $validated['email'];

        if ($request->filled('password')) {
            $customer->password = Hash::make($validated['password']);
        }

        $customer->save();

        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully!');
    }

    public function destroy(User $customer)
    {
        // Ensure we're only deleting customers, not admins
        if ($customer->role !== 'customer') {
            abort(403, 'Unauthorized access.');
        }

        // Check if customer has orders
        if ($customer->orders()->count() > 0) {
            return redirect()->route('admin.customers.index')->with('error', 'Cannot delete customer with existing orders!');
        }

        $customer->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully!');
    }
}
