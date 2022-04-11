<p>
    {{ trans('myapp.name') . ' : ' . $order->name  }}
</p>
<p>
    {{ trans('myapp.contact') . ' : ' . $order->contact  }}
</p>
<p>
    {{ trans('myapp.comments') . ' : ' . $order->comments  }}
</p>
<h2>{{ trans('myapp.products') }}</h2>
@foreach($products as $product)
    <p>
        {{ trans('myapp.title') . ' : ' . $product->title }}
        {{ trans('myapp.description') . ' : ' . $product->description }}
        {{ trans('myapp.price') . ' : ' . $product->price }}
        <img src="{{ asset("image_stored/$product->image_path")  }}">
    </p>
@endforeach
