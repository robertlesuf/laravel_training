<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth')->except('store');
    }

    public function index()
    {
        return view('order.index', ['orders' => Order::getOrdersAndTotals()]);
    }

    public function show($id)
    {
        return view('order.show', ['order' => Order::with('products')->where('id', $id)->first()]);
    }

    public function store(OrderRequest $request)
    {
        $order = Order::create($request->validated());
        $products = Product::getProductsInCart();
        foreach ($products as $product) {
            $syncArray[$product->id] = ['price' => $product->price];
        }
        $order->products()->sync($syncArray);
        Mail::to('me@example.com')->send(new OrderMail($order, $products));
        session()->put(['cart' => []]);
        return redirect()->route('index');
    }
}
