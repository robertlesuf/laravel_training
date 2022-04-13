<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('myapp.order') }}
        </h2>
    </x-slot>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <table>
        <tr>
            <td>{{trans('myapp.name')}}</td>
            <td>{{trans('myapp.contact')}}</td>
            <td>{{trans('myapp.comments')}}</td>
            <td>{{trans('myapp.total')}}</td>
        </tr>
        <tr>
            <td>{{$order->name}}</td>
            <td>{{$order->contact}}</td>
            <td>{{$order->comments}}</td>
            <td>{{$order->total()}}</td>
        </tr>
    </table>
    <h2>Products</h2>
    <table>
        @foreach($order_products as $order_product)
            <tr>
                <td>
                    {{$order_product->product->title}}
                </td>
                <td>
                    {{$order_product->product->description}}
                </td>
                <td>
                    {{$order_product->price}}
                </td>
                <td>
                    <img width="100" src="{{ url('image_stored/' . $order_product->product->image_path) }}" alt="">
                </td>
            </tr>
        @endforeach
    </table>

</x-app-layout>