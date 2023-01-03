@extends('layouts.default')
@section('content')
    <head>
        <link href="{{ asset('css/auctions.css') }}" rel="stylesheet">
        <script>
            var url = "https://api.unsplash.com/search/photos/?query=car&client_id=6evLkKSsWtnP-aTy00ftqLmhMMEEXMzVx4pShcPkWk0"
            fetch(url)
                .then(function(response) {
                    return response.json();
                }).then(function(jsonData){

                var img1 = document.querySelectorAll("#img1"); for(var i = 0; i<img1.length; i++) {img1[i].src = jsonData.results[Math.floor(Math.random() * 9)].urls.full;}
            })

        </script>

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
