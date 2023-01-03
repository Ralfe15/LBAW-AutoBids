@extends('layouts.default')
@section('content')
<head>
<link href="{{ asset('css/auctions.css') }}" rel="stylesheet">
</head>

    <div class="content-wrapper">
        <div class="title-wrapper">
            <h3>Your Auctions</h3>
        </div>

        <div class="navigation-section">
            <a href="/my-auctions" class="active-link">Active Auctions</a>
            <a href="/my-auctions-old" class="inactive-link">Inactive Auctions</a>
        </div>

        <div class="separator">
            <hr class="line">
        </div>

        <section class="results-grid">
            @each('partials/auction', $auctions, 'auction')

        </section>
        <div class="paginator"
            {{$auctions->links("pagination::bootstrap-5")}}
        </div>
    </div>
@stop
