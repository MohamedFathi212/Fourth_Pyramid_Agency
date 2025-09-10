@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>All Posts</h1>
        @auth
            <a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>
        @endauth
    </div>

    @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h3><a class="text-decoration-none" href="{{ route('posts.show', $post) }}">{{ $post->title }} </a></h3>
                <p>{{ Str::limit($post->content, 100) }}</p>
                <small>By {{ $post->user->name }} - {{ $post->created_at->diffForHumans() }}</small>
            </div>
        </div>
    @endforeach
@endsection
