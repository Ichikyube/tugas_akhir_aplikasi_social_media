<h4>Display Comments</h4>
@foreach($post->comments as $comment)
    <div class="display-comment">
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->body }}</p>
    </div>
@endforeach
<hr />
<h4>Add comment</h4>
<form method="post" action="{{ route('comment.add') }}">
    @csrf
    <div class="form-group">
        <input type="text" name="comment_body" class="form-control" />
        <input type="hidden" name="post_id" value="{{ $post->id }}" />
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-warning" value="Add Comment" />
    </div>
</form>
