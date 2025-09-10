<h2>New Comment Added</h2>

<p>
    <strong>{{ $comment->user->name }}</strong>
    ({{ $comment->user->email }})
    wrote a comment:
</p>

<h3>
    {{ $comment->content }}
</h3>

<p>
    On post: <em>{{ $comment->post->title }}</em>  
    <br>
    Written by: <strong>{{ $comment->post->user->name }}</strong> 
    ({{ $comment->post->user->email }})
</p>
