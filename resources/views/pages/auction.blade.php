@extends('layouts.default')
@section('content')
    <script>
        let url = "https://api.unsplash.com/search/photos/?query=car&client_id=6evLkKSsWtnP-aTy00ftqLmhMMEEXMzVx4pShcPkWk0"
        fetch(url)
            .then(function (response) {
                return response.json();
            }).then(function (jsonData) {
            var img1 = document.querySelector("#img1");
            img1.src = jsonData.results[Math.floor(Math.random() * 10)].urls.regular;
        })

    </script>
    <head>
        <link rel="stylesheet" href="/css/auctionDetails.css">
    </head>
    <div class="auction-details-wrapper">

        <div class='auction-title'>
            <p>{{$auction->model->brand->name}} {{$auction->model->name}} </p>
            @if(Auth::check())
                @if($auction->isFavourite(Auth::user()) == 'true')
                    <div>
                        <a style="font-size: 15px; color: black; text-decoration: none"
                           id="{{"toggle".$auction->id}}"
                           onclick="toggleFavorite({{$auction->id}}, '{{$auction->isFavourite(Auth::user())}}')">
                            Remove from favorites :
                            <i id="{{"heart-icon".$auction->id}}" style="color: red" class="bi bi-heart-fill"></i>
                        </a>
                    </div>
                @else
                    <div>
                        <a style="font-size: 15px; color: black; text-decoration: none; margin-right: 30px"
                           class="favorite-btn"
                           id="{{"toggle".$auction->id}}"
                           onclick="toggleFavorite({{$auction->id}}, '{{$auction->isFavourite(Auth::user())}}')">
                            Add to favorites :
                            <i id="{{"heart-icon".$auction->id}}" style="color: black" class="bi bi-heart"></i>
                        </a>
                        <a href="{{route('create_report', ['id'=>$auction->id])}}"
                           style="font-size: 15px; color: black; text-decoration: none; margin-left: 30px"
                        >Report auction</a>
                    </div>
                @endif

            @endif
        </div>

        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @if($auction->images->isEmpty())
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                @else
                    @foreach($auction->images as $img)
                        @if($loop->first)
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="{{$loop->index}}" class="active" aria-current="true"
                                    aria-label="Slide {{ $loop->iteration }}"></button>
                        @else
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="{{ $loop->index }}"
                                    aria-label="Slide {{ $loop->iteration }}"></button>
                        @endif
                    @endforeach
                @endif
            </div>

            <div class="carousel-inner">
                @if($auction->images->isEmpty())
                    <div class="carousel-item active">
                        <img src="" id="img1" class="d-block w-100" alt="...">
                    </div>
                @else
                    @foreach($auction->images as $img)
                        @if($loop->first)
                            <div class="carousel-item active">
                                <img src="{{asset($img->path)}}" class="d-block w-100" alt="...">
                            </div>
                        @else
                            <div class="carousel-item">
                                <img src="{{asset($img->path)}}" class="d-block w-100" alt="...">
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="auction-status-box">
            <div class="description-title">
                <h3>Auction Details</h3></div>
            <div class="auction-status">
                <div class="status-currentbid">
                    <p><b>Current Bid: </b>€{{credits_format($auction->currentWinnerValue()/100)}}</p>
                </div>
                <div class="status-startingbid">
                    <p><b>Starting Bid: </b>€{{credits_format($auction->starting_bid/100)}}</p>
                </div>
                <div class="status-numberbids">
                    <p><b>Number of bids: </b>{{$auction->bids()->count()}} bids</p>
                </div>
                <div class="status-started">
                    <p><b>Started at: </b> {{$auction->started()}}</p>
                </div>
                <div class="status-timeleft">
                    <p id="countdown"><b>Time Left: </b> {{$auction->timeRemainingDetailPage()}}</p>
                </div>
                <div class="status-bid">
                    @if(Auth::check() && $can_bid && (Auth::user()->credits/100) >= $current_bid)
                        <form action="{{route('bid', ['id'=>$auction->id])}}" class="form-label" method="POST">
                            @method('PUT')
                            {{csrf_field()}}
                            <div class="input-group mb-3">

                                <input aria-describedby="button-bid" type="number"
                                       placeholder="Minimum bid: U${{bid_step($current_bid)}}" class="form-control"
                                       min='{{bid_step($current_bid)}}' name="bid" id="bid" step="0.01">
                                <input type="hidden" value="{{bid_step($current_bid)}}" name="minimum">
                                <input type="hidden" value="{{$current_bid}}" name="prev_bid">
                                <input type="hidden" value="{{$prev_id}}" name="prev_id">
                                <button class="btn btn-danger" type="submit" id="button-bid">Bid now!</button>
                            </div>
                        </form>
                        @include('partials/error_list_validator')
                    @endif
                    @if(Auth::check() && $is_winning)
                        <p style="color: red">You are currently winning this auction.</p>
                    @endif
                    @if((Auth::user()->credits/100) < $current_bid)
                        <p style="color: red">You do not have enough money to bid.</p>
                    @endif
                </div>


            </div>
        </div>

        <div class="auction-description-box">
            <div class="description-title">
                <h3>Car Details</h3></div>
            <div class="auction-description">
                <div class="description-brand">
                    <p>
                        <b>Brand: </b> {{$auction->model->brand->name}}</p>
                </div>
                <div class="description-model">
                    <p><b>Model: </b> {{$auction->model->name}}</p>
                </div>
                <div class="description-category">
                    <p><b>Category: </b> {{$auction->category->name}}</p>
                </div>
                <div class="description-year">
                    <p><b>Year: </b> {{$auction->year}}</p>
                </div>
                <div class="description-mileage">
                    <p><b>Mileage: </b> {{$auction->mileage}} km</p>
                </div>
                <div class="description-displacement">
                    <p><b>Displacement: </b> {{$auction->displacement}} cm3</p>
                </div>
                <div class="description-power">
                    <p><b>Power: </b> {{$auction->power}} cv</p>
                </div>
                <div class="description-color">
                    <p><b>Color: </b> {{$auction->color}}</p>
                </div>
                <div class="description-text">
                    <p><b>Description: </b> {{$auction->description}}</p>
                </div>
                <div class="description-text">
                    <p><b>Owner: </b><a class="text-decoration-none"
                                        href="{{route('user_profile', ['id'=> $auction->user->id]) }}"> {{$auction->user->name}}</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="bidding-history-box">
            <div class="description-title">
                <h3>Bidding History</h3></div>
            <div class="bidding-history">
                <div class="bidding-title">
                    <p><b>Bidding History: </b></p>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Member</th>
                        <th scope="col">Value</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    @foreach($prev_bids as $prev_bid)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$prev_bid->user->name}}</td>
                            <td>U${{credits_format($prev_bid->value/100)}}</td>
                            <td>{{date("F j, Y, g:i a", strtotime($prev_bid->date))}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="comments-box">
            <div class="description-title">
                <h3>Comments</h3>
            </div>
            @include('partials/auctionComments', array('id' => $auction->id))
        </div>
    </div>
@stop








