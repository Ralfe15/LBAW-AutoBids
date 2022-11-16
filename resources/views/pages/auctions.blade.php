@include('partials/header')
<link rel="stylesheet" href="{{asset('css/search.css')}}">
<link href="{{ asset('css/auctions.css') }}" rel="stylesheet">

<body>
<div class="content-wrapper">
    <div class="title-wrapper">
        <h1 style="margin-left: 2em">Active auctions</h1>
    </div>
    <section class="results-grid">
        @each('partials/auction', $auctions, 'auction')

    </section>
</div>
</body>
