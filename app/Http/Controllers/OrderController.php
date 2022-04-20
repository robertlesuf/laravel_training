<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('store');
    }

    public function index()
    {
        $orders = Order::all();
        $totals = Order::selectRaw('SUM(order_product.price) as total')->leftJoin('order_product',
            'order_product.order_id', '=', 'orders.id')->groupBy('orders.id')->get();
        return view('orders', ['orders' => $orders, 'totals' => $totals]);
    }

    public function show($id)
    {
        $order = Order::find($id);
        $products = $order->products()->get();
        return view('order', ['order' => $order, 'products' => $products]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'comments' => 'required',
            'products' => 'required'
        ]);
        $order = Order::create([
            'name' => $request->input('name'),
            'contact' => $request->input('contact'),
            'comments' => $request->input('comments'),
        ]);
        $products = Product::whereIn('id', session()->get('cart'))->get();
        $syncArray = array_combine($products->pluck('id')->toArray(), array_map(function ($value) {
            return ['price' => $value];
        }, $products->pluck('price')->toArray()));
        //foreach ($products as $product) {
        //    $syncArray[$product->id] = ['price' => $product->price];
        //}
        $order->products()->sync($syncArray);
        Mail::to('me@example.com')->send(new OrderMail($order, $products));
        session()->put(['cart' => []]);
        return redirect()->route('index');
    }

}
