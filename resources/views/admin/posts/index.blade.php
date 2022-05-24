@extends('layouts.app')

@section('content')
    <div class="container position-relative">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr data-id="{{ $post->slug }}">

                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ date('d/m/Y', strtotime($post->created_at)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($post->updated_at)) }}</td>

                        <td><a class="btn btn-primary" href="{{ route('admin.posts.show', $post) }}">SHOW</a></td>
                        <td>
                            @if (Auth::id() === $post->user_id)
                                <a class="btn btn-secondary" href="{{ route('admin.posts.edit', $post) }}">EDIT</a>
                            @endif
                        </td>

                        <td>
                            @if (Auth::id() === $post->user_id)
                                <button class="btn btn-danger btn-delete" type="button">DELETE</button>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $posts->links() }}

        {{-- delete alert --}}
        <div id="confirmation-delete" class="overlay-alert-delete invisible">
            <div class="content-alert-delete">
                <h2>Wanna Delete?</h2>

                <form class="d-flex my-2" data-base="{{ route('admin.posts.destroy', '*****') }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-outline-danger" type="submit" value="DELETE">DELETE</button>
                </form>

                <button class="btn btn-outline-primary" type="button" id="btn-not-delete">NO, KEEP IT</button>
            </div>
        </div>
    </div>


@endsection
