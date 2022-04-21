<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */

    public function __construct(OrderService $orderService)
    {
        $this->middleware('auth')->except('store');
        $this->orderService = $orderService;
    }

    public function index()
    {
        return view('orders', ['orders' => Order::all(), 'totals' => $totals = Order::getAllTotals()]);
    }

    public function show($id)
    {
        $order = Order::find($id);
        return view('order', ['order' => $order, 'products' => $order->products()->get()]);
    }

    public function store(OrderRequest $request)
    {
        $order = Order::create($request->validated());
        $products = Product::getProductsInCart();
        $this->orderService->syncProducts($products, $order);
        Mail::to('me@example.com')->send(new OrderMail($order, $products));
        session()->put(['cart' => []]);
        return redirect()->route('index');
    }

}
