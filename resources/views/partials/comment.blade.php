<div class="comment-box">
    <div class="comment">
        <div class="comment-user">
            <a href="/user/{{$comment->user->id}}"> {{ $comment->user->name}} </a>
        </div>
        <div class="comment-text">
            {{ $comment->content }}
        </div>
        <div class="comment-date">
            {{ $comment->date() }}
        </div>
        @foreach($comment->children()->get() as $child)
            <div class="comment-child-box">
                <div class="comment-child">
                    <div class="comment-user">
                        <a href="/user/{{$child->user->id}}"> {{ $child->user->name}}
                    </div>
                    <div class="comment-text">
                        {{ $child->content }}
                    </div>
                    <div class="comment-date">
                        {{ $child->date() }}
                    </div>
                </div>
            </div>
        @endforeach
        <div class="button-wrapper">
            <a class="btn btn-outline-danger btn-lg" href="{{route('create_comment', ['id' => $comment->id_auction, 'parent' => $comment->id])}}">
                Reply
            </a>
        </div>
    </div>
</div>
