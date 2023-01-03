@extends('layouts.default')
@section('content')
    <head>
        <link href="{{ asset('css/auctions.css') }}" rel="stylesheet">
    </head>

    <div class="content-wrapper">
        <div class="title-wrapper">
            <h3>Favourite Auctions</h3>
        </div>

        <section class="results-grid">
            @each('partials/auction', $auctions, 'auction')

        </section>
        <div class="paginator"
        {{$auctions->links("pagination::bootstrap-5")}}
    </div>
    </div>
@stop
