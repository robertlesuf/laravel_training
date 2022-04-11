<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
<table>
    @if(isset($cartEmpty))
        {{trans('Cart empty')}}
    @endif
    @if(isset($products))
        @foreach($products as $product)
            <tr>
                <td>{{ $product->title }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <img src="{{ asset("image_stored/$product->image_path")  }}">
                </td>
                <td>
                    <form action="/remove-from-cart" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="submit" value="{{ trans('myapp.remove') }}">
                    </form>
                </td>
            </tr>
        @endforeach
    @endif
</table>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
@endif
<form action="/checkout" method="POST">
    @csrf
    <label for="name">{{ trans('myapp.name') }}</label>
    <input type="text" name="name" id="name" placeholder="{{ trans('myapp.name') }}" value="{{ old('name') }}">
    <label for="contact">{{ trans('myapp.contact') }}</label>
    <input type="text" name="contact" id="contact" placeholder="{{ trans('myapp.contact') }}"
           value="{{ old('contact') }}">
    <label for="comments">{{ trans('myapp.comments') }}</label>
    <input type="text" name="comments" id="comments" placeholder="{{ trans('myapp.comments') }}"
           value="{{ old('comments') }}">
    @if(isset($products))
        <input type="hidden" name="products" value="1">
    @endif
    <input type="submit" value="{{ trans('myapp.checkout') }}">
</form>

<a href="/">{{ trans('myapp.index') }}</a>