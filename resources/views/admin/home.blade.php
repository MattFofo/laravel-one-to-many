@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="row">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- welcome user --}}
                        <div class="col-4">
                            {{ __('Welcome back') }} <br>
                            <b>{{ strTok(Auth::user()->name, ' ') }}</b>
                        </div>


                        <div class="col-8">

                            <a class="btn btn-secondary" href="{{ route('admin.posts.myindex') }}">My Posts</a>

                            <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">New Post</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- post preview ordered by updated date --}}
    <div class="row">
        <div class="col">
            @foreach ($posts as $post)
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="card">

                            <div class="card-body">
                                <a href="{{ route('admin.posts.show', $post) }}">
                                    <h1>{{ $post->title }}</h1>
                                    <small>{{ date('d/m/Y' , strtotime($post->created_at)) }}</small>

                                    {{-- if post updated --}}
                                    @if ($post->created_at != $post->updated_at)
                                        <small>{{ date('d/m/Y' , strtotime($post->updated_at)) }}</small>
                                    @endif
                                    <p>{{ $post->content }}</p>
                                </a>
                                {{-- delete and edit --}}
                                @if (Auth::id() === $post->user_id)
                                    <a class="btn btn-secondary" href="{{ route('admin.posts.edit', $post) }}">EDIT</a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{ $posts->links() }}
    </div>
</div>
@endsection
