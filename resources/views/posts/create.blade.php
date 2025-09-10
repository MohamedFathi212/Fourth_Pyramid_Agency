@extends('layouts.app')

@section('content')
    <h1>Create New Post</h1>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Save Post</button>
    </form>
@endsection
