<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('myapp.product') }}
        </h2>
    </x-slot>
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
<h2>{{ trans('myapp.add-product') }}</h2>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
@endif

<form action="/create-product" enctype="multipart/form-data" method="post">
    @csrf
    <div>
        <strong>{{ trans('myapp.title') }}</strong>
        <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Title">
    </div>
    <div>
        <strong>{{ trans('myapp.description') }}</strong>
        <input type="text" name="description" value="{{ old('description') }}" class="form-control"
               placeholder="Title">
    </div>
    <div>
        <strong>{{ trans('myapp.price') }}</strong>
        <input type="text" name="price" value="{{ old('price') }}" class="form-control" placeholder="Title">
    </div>
    <div>
        <input type="file" name="image" placeholder="Choose image" id="image">
        @error('image')
        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
    </div>
    <input type="submit" value="{{ trans('myapp.create-product') }}">

</form>
</x-app-layout>