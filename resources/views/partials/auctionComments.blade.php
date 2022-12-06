<head>
    <link href="{{ asset('css/auctionComments.css') }}" rel="stylesheet">
</head>
<div class="comments-wrapper">
        @each('partials/comment', $auction->comments->whereNull('id_comment'), 'comment')
</div>
