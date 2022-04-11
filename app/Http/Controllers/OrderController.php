<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                if (Product::find($id)) {
                    $orderProduct = new OrderProduct;
                    $orderProduct->order_id = $order->id;
                    $orderProduct->product_id = $id;
                    $orderProduct->save();
                    $productsForMail[] = Product::find($orderProduct->product_id);
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
        $sums = [];
        foreach ($orders as $key => $order) {
            $sums[$key] = DB::table('order_products')
                ->join('products', 'products.id', '=', 'order_products.product_id')
                ->where('order_products.order_id', '=', $order->id)
                ->sum('products.price');
        }
        return view('orders', ['orders' => $orders, 'sums' => $sums]);
    }

    public function showOrder(Request $request)
    {
        $order = Order::findOrFail($request->input('id'));
        $sum = DB::table('order_products')
            ->join('products', 'products.id', '=', 'order_products.product_id')
            ->where('order_products.order_id', '=', $order->id)
            ->sum('products.price');
        $products = DB::table('order_products')
            ->join('products', 'products.id', '=', 'order_products.product_id')
            ->where('order_products.order_id', '=', $order->id)
            ->get();
        return view('order', ['order' => $order, 'products' => $products, 'sum' => $sum]);
    }
}
