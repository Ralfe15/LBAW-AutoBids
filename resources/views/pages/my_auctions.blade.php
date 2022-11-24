@extends('layouts.default')
@section('content')
<head>
<link href="{{ asset('css/auction.css') }}" rel="stylesheet">
</head>

    <div class="content-wrapper">
        <div class="title-wrapper">
            <h1 style="margin-left: 2em">Your auctions</h1>
        </div>
        <section class="results-grid">
            @each('partials/auction', $auctions, 'auction')

        </section>
    </div>
@stop
