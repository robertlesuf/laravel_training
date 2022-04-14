<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@extends('layouts.app')

@section('content')
    <div class="row justify-content-center ">
        <div class="col-md-8">
            <div class="card p-5">

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
                        @foreach($orders as $key => $order)
                            <tr>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->contact }}</td>
                                <td>{{ $order->comments }}</td>
                                <td>{{ $totals[$key]['total'] }}</td>
                                <td><a href="{{ route('orders.show', [$order->id]) }}">{{trans('myapp.view')}}</a></td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection