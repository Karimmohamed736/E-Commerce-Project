<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\User\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->orderService->getUserOrders();
        return view('User.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = $this->orderService->findOrder($id);
        return view('User.order.show', compact('order'));
    }

    public function makeOrder(Request $request)
    {
        $cart = $request->session()->get('cart');

        if (!$cart) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        try {
            $this->orderService->makeOrder($cart);
            $request->session()->forget('cart');

            return redirect()
                ->route('user.orders.all')
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete(Order $order)
    {
        $this->orderService->deleteOrder($order);

        return redirect()
            ->route('user.orders.all')
            ->with('success', 'Order deleted successfully!');
    }
}
