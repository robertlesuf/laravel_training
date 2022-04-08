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
        <td>{{trans('myapp.products')}}</td>
        <td>{{trans('myapp.total')}}</td>


    </tr>
    <tr>
        <td>{{$order->name}}</td>
        <td>{{$order->contact}}</td>
        <td>{{$order->comments}}</td>
        <td>
            @foreach($products as $product)
                {{ $product->title }}
            @endforeach
        </td>
        <td>
            {{ $sum }}
        </td>
    </tr>
</table>
</x-app-layout>