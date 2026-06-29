<?php

namespace App\Services\User;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function getUserOrders()
    {
        return Order::where('user_id', Auth::id())->get();
    }

    public function findOrder(int $id)
    {
        return Order::findOrFail($id);
    }

    public function makeOrder(array $cart): bool
    {
        foreach ($cart as $id => $value) {
            $product = Product::find($id);

            if ($product->quantity < $value['quantity']) {
                throw new \Exception('Not enough stock for product: ' . $product->name);
            }
        }

        // Use transaction to ensure data integrity
        DB::transaction(function () use ($cart) {
            $totalPrice = collect($cart)->sum('total_price');

            $order = Order::create([
                'user_id'     => Auth::id(),
                'total_price' => $totalPrice,
                'status'      => 'pending',
            ]);

            foreach ($cart as $id => $value) {
                $order->items()->create([
                    'product_id' => $id,
                    'quantity'   => $value['quantity'],
                    'price'      => $value['price'],
                ]);

                Product::find($id)->decrement('quantity', $value['quantity']);
            }
        });

        return true;
    }

    public function deleteOrder(Order $order): void
    {
        $order->delete();
    }
}
