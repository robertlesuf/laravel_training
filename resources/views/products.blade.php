<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('myapp.products') }}
        </h2>
    </x-slot>
    <table>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->title }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <img src="{{ asset("image_stored/$product->image_path")  }}" alt="">
                </td>
                <td>
                    <form action="/delete-product" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="submit" value="{{ trans('myapp.delete') }}">
                    </form>
                </td>
                <td>
                    <a href="{{ route('product-edit',['id' => $product->id]) }}">{{ trans('myapp.edit') }}</a>
                </td>
            </tr>
        @endforeach
    </table>
    <div style="text-align: center">
        <a href="/add-product-page">{{ trans('myapp.add-product') }}</a>
    </div>


</x-app-layout>
