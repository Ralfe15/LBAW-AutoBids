@extends('layouts.default')
@section('content')
    <head>
        <link rel="stylesheet" href="/css/auctionDetails.css">
    </head>

    <div class='auction-title'>
        <p>{{$auction->model->brand->name}} {{$auction->model->name}} </p>
    </div>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @if($auction->images->isEmpty())
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            @else
                @foreach($auction->images as $img)
                    @if($loop->first)
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$loop->index}}" class="active" aria-current="true" aria-label="Slide {{ $loop->iteration }}"></button>
                    @else
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $loop->index }}" aria-label="Slide {{ $loop->iteration }}"></button>
                    @endif
                @endforeach
            @endif
        </div>

        <div class="carousel-inner">
            @if($auction->images->isEmpty())
            <div class="carousel-item active">
                <img src="{{ asset('img/auctions/car_placeholder.png') }}" class="d-block w-100" alt="...">
            </div>
            @else
                @foreach($auction->images as $img)
                    @if($loop->first)
                        <div class="carousel-item active">
                            <img src="{{$img->path}}" class="d-block w-100" alt="...">
                        </div>
                    @else
                        <div class="carousel-item">
                            <img src="{{$img->path}}" class="d-block w-100" alt="...">
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="auction-status-box">
        <div class="auction-status">
            <div class="status-currentbid">
                <p><b>Current Bid: </b>U${{credits_format($auction->currentWinnerValue()/100)}}</p>
            </div>
            <div class="status-startingbid">
                <p><b>Starting Bid: </b>U${{credits_format($auction->starting_bid/100)}}</p>
            </div>
            <div class="status-numberbids">
                <p> <b>Number of bids: </b>{{$auction->bids()->count()}} bids</p>
            </div>
            <div class="status-started">
                <p><b>Started at: </b> {{$auction->start_date}}</p>
            </div>
            <div class="status-timeleft">
                <p><b>Time Left: </b> {{$time_remaining}}</p>
            </div>
            <div class="status-bid">
                @if(Auth::check() && $can_bid && (Auth::user()->credits/100) >= $current_bid)
                    <form action="{{route('bid', ['id'=>$auction->id])}}" class="search" method="POST">
                        @method('PUT')
                        {{csrf_field()}}
                        <label>Enter the value to bid! Minimum bid: U${{bid_step($current_bid)}}</label>
                        <input type="number" min='{{bid_step($current_bid)}}' name="bid" id="bid" step="0.01">
                        <input type="hidden" value="{{bid_step($current_bid)}}" name="minimum">
                        <input type="hidden" value="{{$current_bid}}" name="prev_bid">
                        <input type="hidden" value="{{$prev_id}}" name="prev_id">
                        <button type="submit">Bid now!</button>
                    </form>
                    @include('partials/error_list_validator')
                @endif
            </div>


        </div>
    </div>

    <div class="auction-description-box">
        <div class="auction-description">
            <div class="description-brand">
                <p><b>Brand: </b> {{$auction->model->brand->name}}</p>
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
                <p><b>Owner: </b><a class="text-decoration-none" href="{{route('user_profile', ['id'=> $auction->user->id]) }}"> {{$auction->user->name}}</a></p>
            </div>
        </div>
    </div>
    <div class="auction-description-box">
        <div class="auction-description">
            <div class="description-brand">
                <p><b>Bidding hisory: </b></p>
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

@stop








