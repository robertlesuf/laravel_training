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
                if (Product::find($id)) {
                    $orderProduct = new OrderProduct;
                    $orderProduct->order_id = $order->id;
                    $orderProduct->product_id = $id;
                    $orderProduct->save();
                    $productsForMail[] = Product::find($orderProduct->product_id);
                }
            }

            Mail::to('me@example.com')->send(new OrderMail($order,$productsForMail));
        }
        return redirect()->route('index');
    }

    public function showOrders()
    {
        $orders = Order::all();
        $orders_products = [];
        foreach ($orders as $key => $order) {
            $ids = [];
            $orders_products[$key] = Order::find($order->id)->orderProducts;
            foreach ($orders_products[$key] as $productsList) {
                $products[$key][] = Product::find($productsList->product_id);
                $ids[] = $productsList->product_id;
            }
            $sums[$key] = Product::whereIn('id',$ids)->sum('price');
        }
        return view('orders', ['orders' => $orders, 'products' => $products, 'sums' => $sums]);
    }
    public function showOrder(Request $request)
    {
        $order = Order::findOrFail($request->input('id'));
        $order_products = Order::find($order->id)->orderProducts;
        $ids = [];
        foreach ($order_products as $productsList) {
            $ids[] = $productsList->product_id;
            $products[] = Product::find($productsList->product_id);
        }
        $sum = Product::whereIn('id',$ids)->sum('price');
        return view('order', ['order' => $order, 'products' => $products, 'sum' => $sum]);
    }
}
