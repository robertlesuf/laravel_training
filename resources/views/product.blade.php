<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('myapp.product') }}
        </h2>
    </x-slot>

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <h2>{{ trans('myapp.edit') }}</h2>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    <form action="/update-product" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <strong>{{ trans('myapp.title') }}</strong>
            <input type="text" name="title" value="{{ old('title') ? old('title') : $product->title }}"
                   class="form-control" placeholder="Title">
        </div>
        <div>
            <strong>{{ trans('myapp.description') }}</strong>
            <input type="text" name="description"
                   value="{{ old('description') ? old('description') : $product->description }}" class="form-control"
                   placeholder="Title">
        </div>
        <div>
            <strong>{{ trans('myapp.price') }}</strong>
            <input type="text" name="price" value="{{ old('price') ? old('price') : $product->price }}"
                   class="form-control" placeholder="Title">
        </div>
        <img width="100" height="100" src="{{ asset("image_stored/$product->image_path")  }}" alt="">
        <div>
            <label class="button" for="image">{{ trans('myapp.choose_image') }}</label>
            <input type="file" style="display:none"  name="image" placeholder="" id="image">
        </div>
        <input type="hidden" name="id" value="{{ $product->id }}">
        <input type="submit" value="{{ trans('myapp.update') }}">
    </form>
</x-app-layout>