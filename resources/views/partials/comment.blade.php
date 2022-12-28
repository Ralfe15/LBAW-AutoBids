<div class="comment-box">
    <div class="comment">
        <div class="comment-user">
            <a href="/user/{{$comment->user->id}}"> {{ $comment->user->name}} </a>
        </div>
        <div class="comment-text">
            {{ $comment->content }}
        </div>
        <div class="comment-date">
            {{ $comment->post_date }}
        </div>
        @foreach($comment->children()->get() as $child)
            <div class="comment-child-box">
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
            </div>
        @endforeach
        <div class="button-wrapper">
            <a class="btn btn-secondary btn-lg" href="{{route('create_comment', ['id' => $comment->id_auction, 'parent' => $comment->id])}}">
                Reply
            </a>
        </div>
    </div>
</div>
