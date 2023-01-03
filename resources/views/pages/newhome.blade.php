@extends('layouts.default')
@section('content')
<head>
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>
<script>
    let url = "https://api.unsplash.com/search/photos/?query=car&client_id=6evLkKSsWtnP-aTy00ftqLmhMMEEXMzVx4pShcPkWk0"
    fetch(url)
        .then(function(response) {
            return response.json();
        }).then(function(jsonData){
            document.querySelector("#img1").src = jsonData.results[0].urls.full
            document.querySelector("#img2").src = jsonData.results[1].urls.full
            document.querySelector("#img3").src = jsonData.results[2].urls.full
    })

</script>
<div id="carouselCaptions" class="carousel slide top-carousel" data-bs-ride="false">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="" style="object-fit: cover;" id="img1" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Buy your vehicles!</h5>
                <p>Buy high-quality second-hand vehicles.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="" style="object-fit: cover;" id="img2" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Sell your vehicles!</h5>
                <p>Sell high-quality second-hand vehicles.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="" style="object-fit: cover;" id="img3" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>About AutoBids</h5>
                <p>Want to know more about us?</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<div class="navigation-section">
    <a href="#latestCarousel" class="latest-link">Latest Auctions</a>
    <a href="#finishingCarousel" class="finishing-link">Finishing Auctions</a>
    <a href="#popularCarousel" class="popular-link">Popular Auctions</a>
</div>

<div class="separator">
    <hr class="line">
</div>


<div class="content-wrapper">
    <div class="latest-actions-wrapper">
        <div class="latest-text">
            <h2> Latest Auctions</h2>
        </div>
        <div class="container text-center my-3">
            <div class="row mx-auto my-auto justify-content-center">
                <div id="latestCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner multi-carousel-inner" role="listbox">
                        @foreach($auctions_latest as $auction)
                            @if($loop->first)
                                <div class="carousel-item multi-carousel-item active" id="latest-carousel">
                                    @else
                                        <div class="carousel-item multi-carousel-item" id="latest-carousel">
                                            @endif
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <a href="/auction/{{$auction->id}}">
                                                    <div class="card-img">
                                                        @if($auction->images->isEmpty())
                                                            <img src="{{ asset('img/auctions/car_placeholder_square200.png') }}" class="img-fluid">
                                                        @else
                                                            <img src="{{ asset($auction->images->first()->path) }}" class="img-fluid">
                                                        @endif
                                                            @if(Auth::check())
                                                                @if($auction->isFavourite(Auth::user()) == 'true')
                                                                    <div>
                                                                        <a style="font-size: 25px; color: black; text-decoration: none"
                                                                           id="{{"toggle".$auction->id}}"
                                                                           onclick="toggleFavorite({{$auction->id}}, '{{$auction->isFavourite(Auth::user())}}')">
                                                                            <i id="{{"heart-icon".$auction->id}}" class="bi bi-heart-fill"></i>
                                                                        </a>
                                                                    </div>
                                                                @else
                                                                    <div>
                                                                        <a style="font-size: 25px; color: black; text-decoration: none"
                                                                           class="favorite-btn"
                                                                           id="{{"toggle".$auction->id}}"
                                                                           onclick="toggleFavorite({{$auction->id}}, '{{$auction->isFavourite(Auth::user())}}')">
                                                                            <i id="{{"heart-icon".$auction->id}}" class="bi bi-heart"></i>
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                    </div>
{{--                                                    <div class="card-img-overlay">{{$loop->iteration}}</div>--}}
                                                    <div class="card-caption">
                                                        <h5><b>{{$auction->model->brand->name}}</b></h5>
                                                        <h6>{{$auction->model->name }}</h6>
                                                        <p>{{ $auction->year }}</p>
                                                        <p>{{$auction->mileage}} km</p>
                                                        <p>${{credits_format($auction->currentWinnerValue()/100)}}</p>
                                                        @if(!$auction->approved)
                                                            <p style="color: red" class="text-red">Not approved</p>
                                                        @elseif(!$auction->active)
                                                            <p style="color: red" class="text-red">Expired</p>
                                                        @else
                                                            <p id="{{processTimeHTML($auction->timeRemaining(), $auction->id)}}"
                                                            >{{$auction->timeRemaining()}}</p>
                                                        @endif
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                </div>
                                <a class="multi-carousel-control-prev carousel-control-prev bg-transparent w-aut" href="#latestCarousel" role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </a>
                                <a class="multi-carousel-control-next carousel-control-next bg-transparent w-aut" href="#latestCarousel" role="button" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </a>
                    </div>
                </div>
            </div>
    </div>

    <div class="finishing-actions-wrapper">
        <div class="finishing-text">
            <h2> Finishing Auctions</h2>
        </div>
        <div class="container text-center my-3">
            <div class="row mx-auto my-auto justify-content-center">
                <div id="finishingCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner multi-carousel-inner" role="listbox">
                        @foreach($auctions_finishing as $auction)
                            @if($loop->first)
                                <div class="carousel-item multi-carousel-item active" id="finishing-carousel">
                                    @else
                                        <div class="carousel-item multi-carousel-item" id="finishing-carousel">
                                            @endif
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <a href="/auction/{{$auction->id}}">
                                                        <div class="card-img">
                                                            @if($auction->images->isEmpty())
                                                                <img src="{{ asset('img/auctions/car_placeholder_square200.png') }}" class="img-fluid">
                                                                @else
                                                                    <img src="{{ asset($auction->images->first()->path) }}" class="img-fluid">
                                                                    @endif
                                                        </div>
{{--                                                        <div class="card-img-overlay">{{$loop->iteration}}</div>--}}
                                                        <div class="card-caption">
                                                            <h5><b>{{$auction->model->brand->name}}</b></h5>
                                                            <h6>{{$auction->model->name }}</h6>
                                                            <p>{{ $auction->year }}</p>
                                                            <p>{{$auction->mileage}} km</p>
                                                            <p>${{credits_format($auction->currentWinnerValue()/100)}}</p>
                                                            @if(!$auction->approved)
                                                                <p style="color: red" class="text-red">Not approved</p>
                                                            @elseif(!$auction->active)
                                                                <p style="color: red" class="text-red">Expired</p>
                                                            @endif
                                                            <p>{{ $auction->remaining() }}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                </div>
                                <a class="multi-carousel-control-prev carousel-control-prev bg-transparent w-aut" href="#finishingCarousel" role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </a>
                                <a class="multi-carousel-control-next carousel-control-next bg-transparent w-aut" href="#finishingCarousel" role="button" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </a>
                    </div>
                </div>
            </div>
    </div>

    <div class="popular-actions-wrapper">
        <div class="popular-text">
            <h2> Popular Auctions</h2>
        </div>
        <div class="container text-center my-3">
            <div class="row mx-auto my-auto justify-content-center">
                <div id="popularCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner multi-carousel-inner" role="listbox">
                        @foreach($auctions_popular as $auction)
                            @if($loop->first)
                                <div class="carousel-item multi-carousel-item active" id="popular-carousel">
                                    @else
                                        <div class="carousel-item multi-carousel-item" id="popular-carousel">
                                            @endif
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <a href="/auction/{{$auction->id}}">
                                                        <div class="card-img">
                                                            @if($auction->images->isEmpty())
                                                                <img src="{{ asset('img/auctions/car_placeholder_square200.png') }}" class="img-fluid">
                                                            @else
                                                                <img src="{{ asset($auction->images->first()->path) }}" class="img-fluid">
                                                            @endif
                                                        </div>
{{--                                                        <div class="card-img-overlay">{{$loop->iteration}}</div>--}}
                                                        <div class="card-caption">
                                                            <h5><b>{{$auction->model->brand->name}}</b></h5>
                                                            <h6>{{$auction->model->name }}</h6>
                                                            <p>{{ $auction->year }}</p>
                                                            <p>{{$auction->mileage}} km</p>
                                                            <p>${{credits_format($auction->currentWinnerValue()/100)}}</p>
                                                            @if(!$auction->approved)
                                                                <p style="color: red" class="text-red">Not approved</p>
                                                            @elseif(!$auction->active)
                                                                <p style="color: red" class="text-red">Expired</p>
                                                            @endif
                                                            <p>{{ $auction->remaining() }}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                </div>
                                <a class="multi-carousel-control-prev carousel-control-prev bg-transparent w-aut" href="#popularCarousel" role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </a>
                                <a class="multi-carousel-control-next carousel-control-next bg-transparent w-aut" href="#popularCarousel" role="button" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </a>
                    </div>
                </div>
    </div>
</div>

        <a onclick=topFunction() class="btn btn-danger" id="top-button"><i class="bi bi-caret-up"></i></a>
<script>
    let items = document.querySelectorAll('#latestCarousel #latest-carousel')

    items.forEach((el) => {
        const minPerSlide = 4
        let next = el.nextElementSibling
        for (var i=1; i<minPerSlide; i++) {
            if (!next) {
                // wrap carousel by using first child
                next = items[0]
            }
            let cloneChild = next.cloneNode(true)
            el.appendChild(cloneChild.children[0])
            next = next.nextElementSibling
        }
    })
</script>
<script>
    let items2 = document.querySelectorAll('#popularCarousel #popular-carousel')

    items2.forEach((el) => {
        const minPerSlide = 4
        let next = el.nextElementSibling
        for (var i=1; i<minPerSlide; i++) {
            if (!next) {
                // wrap carousel by using first child
                next = items2[0]
            }
            let cloneChild = next.cloneNode(true)
            el.appendChild(cloneChild.children[0])
            next = next.nextElementSibling
        }
    })
</script>
<script>
    let items3 = document.querySelectorAll('#finishingCarousel #finishing-carousel')

    items3.forEach((el) => {
        const minPerSlide = 4
        let next = el.nextElementSibling
        for (var i=1; i<minPerSlide; i++) {
            if (!next) {
                // wrap carousel by using first child
                next = items3[0]
            }
            let cloneChild = next.cloneNode(true)
            el.appendChild(cloneChild.children[0])
            next = next.nextElementSibling
        }
    })
</script>
<script>
    // Get the button
    let mybutton = document.getElementById("top-button");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
@stop
