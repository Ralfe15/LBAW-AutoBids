@extends('layouts.default')
@section('content')
    <head>
        <link rel="stylesheet" href="{{ asset('css/auctions.css') }}">
    </head>

    <div class="content-wrapper">
        <div class="title-wrapper">
            <h3>Active Auctions</h3>
        </div>
        <section class="results-grid">
            @each('partials/auction', $auctions, 'auction')
        </section>
        <div class="paginator"
            {{$auctions->links("pagination::bootstrap-5")}}
        </div>
    </div>
@stop

