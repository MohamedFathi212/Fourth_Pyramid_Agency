@extends('layouts.app')

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            <p><small>By {{ $post->user->name }} - {{ $post->created_at->toDayDateTimeString() }}</small></p>

            @if($post->user_id === auth()->id())
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            @endif
        </div>
    </div>



    <h4 class="mb-3">Comments</h4>
@foreach($post->comments as $comment)
    <div class="card mb-2 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <p class="mb-1">{{ $comment->content }}</p>
                <small class="text-muted">
                    by {{ $comment->user->name }} • {{ $comment->created_at->diffForHumans() }}
                </small>
            </div>

            @if($comment->user_id === auth()->id())
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="ms-3">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        Delete
                    </button>
                </form>
            @endif
        </div>
    </div>
@endforeach



    @auth
        <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-3">
            @csrf
            <textarea name="content" class="form-control mb-2" placeholder="Write a comment..." required></textarea>
            <button type="submit" class="btn btn-primary">Add Comment</button>
        </form>
    @endauth
    
@endsection
