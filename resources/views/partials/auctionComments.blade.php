<head>
    <link href="{{ asset('css/auctionComments.css') }}" rel="stylesheet">
</head>
<div class="comments-wrapper">
    @each('partials/comment', $auction->comments->whereNull('id_comment'), 'comment')
    <div class="button-wrapper">
        <a class="btn btn-outline-danger btn-lg" href="{{route('create_comment', ['id' => $auction->id, 'parent' => null])}}">
            Comment
        </a>
    </div>
</div>
