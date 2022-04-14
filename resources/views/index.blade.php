<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@extends('layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-md-8">
            <div class="card p-5">
                <table>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <img width="100" src="{{ asset("images/$product->image_path") }}" alt="">
                            </td>
                            <td>
                                <form action="{{ route('cart.store',['id' => $product->id]) }}" method="POST">
                                    @csrf
                                    <input type="submit" value="{{ trans('myapp.add') }}">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <a href="{{ route('cart.index') }}">{{ trans('myapp.cart') }}</a>
            </div>
        </div>
    </div>
@endsection