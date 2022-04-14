<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@extends('layouts.app')
@section('content')
    <table>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->title }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <img width="100" src="{{ asset("images/$product->image_path")  }}" alt="">
                </td>
                <td>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="{{ trans('myapp.delete') }}">
                    </form>
                </td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}">{{ trans('myapp.edit') }}</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

