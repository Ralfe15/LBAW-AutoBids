@extends('layouts.default')
@section('content')
<head>
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auction.css') }}" rel="stylesheet">
</head>

@if(Auth::check())
{{--    TODO: Handle these endpoints--}}
<div class="button-wrapper">
    <a class="central-button" href='{{route('my_auctions')}}'>Your owned auctions</a>
    <a class="central-button" href=''>Your favorite auctions</a>
    <a class="central-button" href='{{route('auctions')}}'>View active auctions</a>
</div>
@endif
<div class="content-wrapper">
    <div class="latest-actions-wrapper">
        <div class="latest-text">
            <h2> Latest Auctions</h2>
        </div>
        <section class="results-grid">
            @each('partials/auction', $auctions_latest, 'auction')
        </section>
    </div>

    <div class="finishing-actions-wrapper">
        <div class="finishing-text">
            <h2> Finishing Auctions</h2>
        </div>
        <section class="results-grid">
            @each('partials/auction', $auctions_finishing, 'auction')
        </section>
    </div>

    <div class="popular-actions-wrapper">
        <div class="popular-text">
            <h2> Popular Auctions</h2>
        </div>
        <section class="results-grid">
            @each('partials/auction', $auctions_popular, 'auction')
        </section>
    </div>
</div>
@stop
