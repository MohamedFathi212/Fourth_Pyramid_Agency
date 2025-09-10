@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>

    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ $post->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control" rows="5" required>{{ $post->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-warning">Update Post</button>
    </form>
@endsection
