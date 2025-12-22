<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'customer')->get();
        $products = Product::all();

        $statuses = ['pending', 'processing', 'completed', 'cancelled', 'refunded'];

        // Create 25 orders with order items
        for ($i = 0; $i < 25; $i++) {
            $user = $users->random();
            $status = $i < 15 ? 'completed' : $statuses[array_rand($statuses)];

            $subtotal = 0;
            $orderProducts = $products->random(rand(1, 4));

            $order = Order::create([
                'user_id' => $user->id,
                'customer_name' => $user->name,
                'customer_email' => $user->email,
                'customer_phone' => '+1-555-' . rand(1000, 9999),
                'subtotal' => 0, // Will update later
                'tax' => 0, // Will calculate later
                'shipping' => rand(0, 1) ? 15.00 : 0.00,
                'total' => 0, // Will calculate later
                'status' => $status,
                'payment_method' => ['Credit Card', 'PayPal', 'Debit Card'][array_rand(['Credit Card', 'PayPal', 'Debit Card'])],
                'shipping_address' => $user->name . "\n123 Main St\nAnytown, CA 90210\nUSA",
                'billing_address' => $user->name . "\n123 Main St\nAnytown, CA 90210\nUSA",
                'notes' => rand(0, 3) == 0 ? 'Please handle with care' : null,
            ]);

            // Create order items
            foreach ($orderProducts as $product) {
                $quantity = rand(1, 3);
                $price = $product->price;
                $itemSubtotal = $price * $quantity;
                $subtotal += $itemSubtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $itemSubtotal,
                ]);
            }

            // Update order totals
            $tax = $subtotal * 0.08; // 8% tax
            $total = $subtotal + $tax + $order->shipping;

            $order->update([
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
            ]);
        }

        // Create a few guest orders (without user_id)
        for ($i = 0; $i < 5; $i++) {
            $guestNames = ['Alice Johnson', 'Bob Smith', 'Carol White', 'Dan Brown', 'Emma Davis'];
            $guestName = $guestNames[$i];
            $guestEmail = strtolower(str_replace(' ', '.', $guestName)) . '@example.com';

            $subtotal = 0;
            $orderProducts = $products->random(rand(1, 3));
            $status = $statuses[array_rand($statuses)];

            $order = Order::create([
                'user_id' => null,
                'customer_name' => $guestName,
                'customer_email' => $guestEmail,
                'customer_phone' => '+1-555-' . rand(1000, 9999),
                'subtotal' => 0,
                'tax' => 0,
                'shipping' => 15.00,
                'total' => 0,
                'status' => $status,
                'payment_method' => 'Credit Card',
                'shipping_address' => $guestName . "\n456 Oak Ave\nSomewhere, NY 10001\nUSA",
                'billing_address' => $guestName . "\n456 Oak Ave\nSomewhere, NY 10001\nUSA",
                'notes' => null,
            ]);

            foreach ($orderProducts as $product) {
                $quantity = rand(1, 2);
                $price = $product->price;
                $itemSubtotal = $price * $quantity;
                $subtotal += $itemSubtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $itemSubtotal,
                ]);
            }

            $tax = $subtotal * 0.08;
            $total = $subtotal + $tax + $order->shipping;

            $order->update([
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
            ]);
        }
    }
}
