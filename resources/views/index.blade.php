<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
<table>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->title }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price }}</td>
            <td>
                <img src="{{ url('image_stored/' . $product->image_path) }}" alt="">
            </td>
            <td>
                <form action="/add" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="submit" value="{{ trans('myapp.add') }}">
                </form>
            </td>
        </tr>
    @endforeach
</table>

<a href="/cart">{{ trans('myapp.cart') }}</a>