<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{


    public function makeOrder(Request $request)
    {

        $cart = $request->session()->get('cart');
        $totalPrice = 0;
        if (!$cart) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        foreach ($cart as $value) {
            $totalPrice += $value['total_price'];
        }

        $order = Order::create([
            'user_id'=>Auth::id(),
            'total_price'=>$totalPrice,
            'status'=>'pending',
        ]);

        foreach ($cart as $id => $value) {
            $product = Product::find($id);

            if ($product->quantity < $value['quantity']) {
                return redirect()->back()->with('error', 'Not enough stock for product: ' . $product->name);
            }

            $order->items()->create([
                'product_id' => $id,
                'quantity' => $value['quantity'],
                'price' => $value['price'],
            ]);

            $product->quantity -= $value['quantity'];
            $product->save();
        }

        $request->session()->forget('cart');
        return redirect()->route('user.orders.all')->with('success', 'Order placed successfully!');

    }

        public function index(){
        $orders = Order::where('user_id',Auth::id())->get();
        return view('User.order.index',compact('orders'));
    }

    public function show($id){
        $order = Order::findOrFail($id);
        return view('User.order.show',compact('order'));
    }

    public function delete($id){
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('user.orders.all')->with('success', 'Order deleted successfully!');

    }

}
