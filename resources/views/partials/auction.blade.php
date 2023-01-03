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
