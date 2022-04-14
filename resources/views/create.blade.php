<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@extends('layouts.app')

@section('content')

    <div class="row justify-content-center ">
        <div class="col-md-8">
            <div class="card p-5">
                <h2>{{ trans('myapp.add-product') }}</h2>
                <form action="{{ route('products.store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div>
                        <strong>{{ trans('myapp.title') }}</strong>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                               placeholder="{{ trans('myapp.title') }}">
                        @error('title')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <strong>{{ trans('myapp.description') }}</strong>
                        <input type="text" name="description" value="{{ old('description') }}" class="form-control"
                               placeholder="{{ trans('myapp.description') }}">
                        @error('description')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <strong>{{ trans('myapp.price') }}</strong>
                        <input type="text" name="price" value="{{ old('price') }}" class="form-control"
                               placeholder="{{ trans('myapp.price') }}">
                        @error('price')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <div>
                            <label class="button" for="image">{{ trans('myapp.choose-image') }}</label>
                            <input type="file" style="display:none" name="image" placeholder="" id="image">
                        </div>
                        @error('image')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="submit" value="{{ trans('myapp.create-product') }}">
                </form>
            </div>
        </div>
    </div>
@endsection