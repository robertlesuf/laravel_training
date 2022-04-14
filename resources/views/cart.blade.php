<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@extends('layouts.app')

@section('content')
    <div class="row justify-content-center ">
        <div class="col-md-8">
            <div class="card p-5">
                @if($products->isempty())
                    {{ __('Cart empty' )}}
                @endif
                @error('products')
                <div class="alert alert-danger mt-1 mb-1">{{ __('Products are required') }}</div>
                @enderror
                <table>
                    @if(isset($products))
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <img width="100" src="{{ asset("images/$product->image_path")  }}">
                                </td>
                                <td>
                                    <form action="{{ route('cart.destroy', [$product->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="{{ trans('myapp.remove') }}">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <label for="name">{{ trans('myapp.name') }}</label>
                    <input type="text" name="name" id="name" placeholder="{{ trans('myapp.name') }}"
                           value="{{ old('name') }}">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <label for="contact">{{ trans('myapp.contact') }}</label>
                    <input type="text" name="contact" id="contact" placeholder="{{ trans('myapp.contact') }}"
                           value="{{ old('contact') }}">
                    @error('contact')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <label for="comments">{{ trans('myapp.comments') }}</label>
                    <input type="text" name="comments" id="comments" placeholder="{{ trans('myapp.comments') }}"
                           value="{{ old('comments') }}">
                    @error('comments')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror

                    @if(!$products->isempty())
                        <input type="hidden" name="products" id="comments" value="1">
                    @endif
                    @error('products')
                    <div class="alert alert-danger mt-1 mb-1">{{ __('Products are required') }}</div>
                    @enderror

                    <input type="submit" value="{{ trans('myapp.checkout') }}">
                </form>
                <a href="/">{{ trans('myapp.index') }}</a>
            </div>
        </div>
    </div>
@endsection