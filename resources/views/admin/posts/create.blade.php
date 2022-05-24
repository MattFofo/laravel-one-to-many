@extends('layouts.app')


@section('content')
    <div class="container">

        <form method="POST" action="{{ route('admin.posts.store') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="title">{{ __('Post title') }}</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="title" value="{{ old('title')}}">
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group mb-3">
                <label for="slug">{{ __('Slug') }}</label>
                <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" value="{{ old('slug')}}">
                <button type="button" class="btn btn-primary mt-1" id="generateSlug">Generate Slug</button>
            </div>
            @error('slug')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            {{-- categories --}}
            <select class="form-select mb-3" aria-label="Default select example" name="category_id" id="category">
                <option value="">Select a category</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == old('category_id')) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group mb-3">
                <label for="content">{{ __('Description') }}</label>
                <textarea class="form-control" id="content" rows="4" placeholder="content" name="content">{{ old('content')}}</textarea>
            </div>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary my-3">{{ __('Submit') }}</button>
        </form>

        <a class="btn btn-dark" href="{{ url()->previous() }}">BACK</a>
    </div>
@endsection
