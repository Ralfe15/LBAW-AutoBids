<div class="comment">
    <div class="comment-user">
        {{ $comment->user->name}}
    </div>
    <div class="comment-text">
        {{ $comment->content }}
    </div>
    <div class="comment-date">
        {{ $comment->post_date }}
    </div>
    @foreach($comment->children()->get() as $child)
    <div class="comment-child">
        <div class="comment-user">
            {{ $child->user->name}}
        </div>
        <div class="comment-text">
            {{ $child->content }}
        </div>
        <div class="comment-date">
            {{ $child->post_date }}
        </div>
    </div>
    @endforeach
</div>
