@extends('layouts.app')


@section('content')
    <div class="container">

        <form method="POST" action="{{ route('admin.posts.update', $post) }}">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="title">Post title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="title" value="{{ old(('content'), $post->title) }}">
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group mb-3">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" value="{{ old(('content'), $post->slug) }}">
                <button type="button" class="btn btn-primary" id="generateSlug">Generate Slug</button>
            </div>
            @error('slug')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            {{-- categories --}}
            <select class="form-select mb-3" aria-label="Default select example" name="category_id" id="category">
                {{-- <option value="{{ $post->category->id }}">{{ $post->category->name }}</option> --}}

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @if ($category->id == old('category_id')) selected @endif
                        @if ($category->name == old('category_name')) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group mb-3">
                <label for="content">Description</label>
                <textarea class="form-control" id="content" rows="4" placeholder="content" name="content">{{ old(('content'), $post->content) }}</textarea>
            </div>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <a class="btn btn-dark" href="{{ url()->previous() }}">BACK</a>
    </div>
@endsection
