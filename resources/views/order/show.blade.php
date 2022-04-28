@extends('layouts.app')

@section('content')>
<div class="row justify-content-center ">
    <div class="col-md-8">
        <div class="card p-5">
            <table>
                <tr>
                    <td>{{ trans('myapp.name') }}</td>
                    <td>{{ trans('myapp.contact') }}</td>
                    <td>{{ trans('myapp.comments') }}</td>
                    <td>{{ trans('myapp.total') }}</td>
                </tr>
                <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->contact }}</td>
                    <td>{{ $order->comments }}</td>
                    <td>{{ $order->total() }}</td>
                </tr>
            </table>
            <h2>{{ __('Products') }}</h2>
            <table>
                @foreach ($order->products as $product)
                    <tr>
                        <td>
                            {{ $product->title }}
                        </td>
                        <td>
                            {{ $product->description }}
                        </td>
                        <td>
                            {{ $product->pivot->price }}
                        </td>
                        <td>
                            <img width="100" src="{{ url('images/' . $product->image_path) }}" alt="">
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection