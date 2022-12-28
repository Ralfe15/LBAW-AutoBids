@extends('layouts.default')
@section('content')
<head>
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
{{--    <link href="{{ asset('css/auction.css') }}" rel="stylesheet">--}}
</head>



<div id="carouselCaptions" class="carousel slide top-carousel" data-bs-ride="false">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://placeimg.com/1920/600/any" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Buy your vehicles!</h5>
                <p>Buy high-quality second-hand vehicles.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://placeimg.com/1920/750/any" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Sell your vehicles!</h5>
                <p>Sell high-quality second-hand vehicles.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://placeimg.com/1920/400/any" class="d-block w-100" alt="...">
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
                                                        <img src="{{ asset('img/auctions/car_placeholder_square200.png') }}" class="img-fluid">
                                                    </div>
                                                    <div class="card-img-overlay">{{$loop->iteration}}</div>
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
                                <a class="carousel-control-prev bg-transparent w-aut" href="#latestCarousel" role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </a>
                                <a class="carousel-control-next bg-transparent w-aut" href="#latestCarousel" role="button" data-bs-slide="next">
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
                                                            <img src="{{ asset('img/auctions/car_placeholder_square200.png') }}" class="img-fluid">
                                                        </div>
                                                        <div class="card-img-overlay">{{$loop->iteration}}</div>
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
                                <a class="carousel-control-prev bg-transparent w-aut" href="#finishingCarousel" role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </a>
                                <a class="carousel-control-next bg-transparent w-aut" href="#finishingCarousel" role="button" data-bs-slide="next">
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
                                                            <img src="{{ asset('img/auctions/car_placeholder_square200.png') }}" class="img-fluid">
                                                        </div>
                                                        <div class="card-img-overlay">{{$loop->iteration}}</div>
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
                                <a class="carousel-control-prev bg-transparent w-aut" href="#popularCarousel" role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </a>
                                <a class="carousel-control-next bg-transparent w-aut" href="#popularCarousel" role="button" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </a>
                    </div>
                </div>
    </div>
</div>
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
@stop
