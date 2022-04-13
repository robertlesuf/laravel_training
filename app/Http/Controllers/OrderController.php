<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'comments' => 'required',
            'products' => 'required'
        ]);
        $cart = session()->get('cart');
        if ($cart) {
            $order = new Order;
            $order->name = $request->input('name');
            $order->contact = $request->input('contact');
            $order->comments = $request->input('comments');
            $order->save();
            $productsForMail = [];
            foreach ($cart as $id) {
                if ($prod = Product::find($id)) {
                    $orderProduct = new OrderProduct;
                    $orderProduct->order_id = $order->id;
                    $orderProduct->product_id = $id;
                    $orderProduct->price = $prod->price;
                    $orderProduct->save();
                    $productsForMail[] = $prod;
                }
            }
            Mail::to('me@example.com')->send(new OrderMail($order, $productsForMail));
            return redirect()->route('index');
        } else {
            return redirect()->route('cart');
        }
    }

    public function showOrders()
    {
        $orders = Order::all();

        return view('orders', ['orders' => $orders]);
    }

    public function showOrder($id)
    {
        $order = Order::findOrFail($id);
        $order_products = $order->orderProducts;
        return view('order', ['order' => $order, 'order_products' => $order_products]);
    }
}
