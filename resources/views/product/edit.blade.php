@extends('layouts.app')

@section('content')
    <div class="row justify-content-center ">
        <div class="col-md-8">
            <div class="card p-5">
                <h2>{{ trans('myapp.edit') }}</h2>
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <strong>{{ trans('myapp.title') }}</strong>
                        <input type="text" name="title" value="{{ old('title', $product->title) }}"
                               class="form-control" placeholder="{{ trans('myapp.title') }}">
                        @error('title')
                        <div class="alert alert-danger mt-1 mb-1">{{ __('Title is required') }}</div>
                        @enderror
                    </div>
                    <div>
                        <strong>{{ trans('myapp.description') }}</strong>
                        <input type="text" name="description"
                               value="{{ old('description', $product->description) }}"
                               class="form-control"
                               placeholder="{{ trans('myapp.description') }}">
                        @error('description')
                        <div class="alert alert-danger mt-1 mb-1">{{ __('Description is required') }}</div>
                        @enderror
                    </div>
                    <div>
                        <strong>{{ trans('myapp.price') }}</strong>
                        <input type="text" name="price" value="{{ old('price', $product->price) }}"
                               class="form-control" placeholder="{{ trans('myapp.price') }}">
                        @error('price')
                        <div class="alert alert-danger mt-1 mb-1">{{ __('Price is required') }}</div>
                        @enderror
                    </div>
                    <img width="100" height="100" src="{{ asset("images/$product->image_path")  }}" alt="">
                    <div>
                        <label class="button" for="image">{{ trans('myapp.choose_image') }}</label>
                        <input type="file" style="display:none" name="image" placeholder="" id="image">
                    </div>
                    @error('image')
                    <div class="alert alert-danger mt-1 mb-1">{{ __('Something is wrong with the image') }}</div>
                    @enderror
                    <input type="submit" value="{{ trans('myapp.update') }}">
                </form>
            </div>
        </div>
    </div>
@endsection