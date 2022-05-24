@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <h1>{{ $post->title }}</h1>
                <b>{{ $post->user->name }}</b>
                <small>Data pubblicazione: {{ date('d/m/Y' , strtotime($post->created_at)) }}</small>

                {{-- if post updated --}}
                @if ($post->created_at != $post->updated_at)
                    <small>Data ultima modifica: {{ date('d/m/Y' , strtotime($post->updated_at)) }}</small>
                @endif

                <b>tel. {{ $post->user->infouser->phone }}</b>
                <h4><span class="badge bg-primary">{{ $post->category->name }}</span></h4>

                <p>{{ $post->content }}</p>
            </div>
        </div>
    </div>
@endsection
