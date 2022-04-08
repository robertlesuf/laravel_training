<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('myapp.orders') }}
        </h2>
    </x-slot>

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <h2>{{trans('myapp.orders')}}</h2>

    <table>
        <tr>
            <td>{{trans('myapp.name')}}</td>
            <td>{{trans('myapp.contact')}}</td>
            <td>{{trans('myapp.comments')}}</td>
            <td>{{trans('myapp.products')}}</td>
            <td>{{trans('myapp.total')}}</td>
            <td>{{trans('myapp.order')}}</td>

        </tr>


        @foreach($orders as $key => $order)
            <tr>
                <td>{{$order->name}}</td>
                <td>{{$order->contact}}</td>
                <td>{{$order->comments}}</td>
                <td>
                    @if($products)
                        @foreach($products[$key] as $product)
                            {{ $product->title }}
                        @endforeach
                    @endif
                </td>
                <td>{{ $sums[$key] }}</td>
                <td>
                    <a href="{{ route('order',['id' => $order->id ]) }}">{{trans('myapp.view')}}</a>
                </td>
            </tr>
        @endforeach


    </table>

</x-app-layout>