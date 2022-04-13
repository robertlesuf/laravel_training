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
            <td>{{trans('myapp.total')}}</td>
            <td>{{trans('myapp.order')}}</td>
        </tr>

        @if(isset($orders))
            @foreach($orders as  $order)
                <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->contact }}</td>
                    <td>{{ $order->comments }}</td>
                    <td>{{ $order->total() }}</td>
                    <td> <a href="{{ url('/order',['id' => $order->id ]) }}">{{trans('myapp.view')}}</a></td>
                </tr>
            @endforeach
        @endif

    </table>
</x-app-layout>