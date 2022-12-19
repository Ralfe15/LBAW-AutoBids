<meta name="_token" id="token" content="{{ csrf_token() }}">
<div class="card">

    <a href="{{route('detail', ['id'=> $auction->id]) }}"
       @if(!$auction->active || !$auction->approved)
           style="pointer-events: none; cursor: default;"
        @endif
    >
        @if($auction->images->isEmpty())
            <img src='{{ asset('img/auctions/car_placeholder_square200.png') }}'>
        @else
            <img src={{ asset($auction->images->first()->path) }}>
        @endif

        <div class="container">
            <h4><b>{{$auction->model->brand->name}} {{$auction->model->name }} - {{ $auction->year }}</b></h4>
            <p>Mileage: {{$auction->mileage}}</p>
            <p>Current Bid: U${{credits_format($auction->currentWinnerValue()/100)}}</p>
            @if(!$auction->approved)
                <p style="color: red" class="text-red">Not approved</p>
            @elseif(!$auction->active)
                <p style="color: red" class="text-red">Expired</p>
            @endif

        </div>
    </a>
    @if(Auth::check())
        @if($auction->isFavourite(Auth::user()) == 'true')
            <div>
                <a style="font-size: 15px"
                   class="favorite-btn"
                   id="{{"toggle".$auction->id}}"
                   onclick="toggleFavorite({{$auction->id}}, '{{$auction->isFavourite(Auth::user())}}')">
                    Remove from favorites :
                    <i id="{{"heart-icon".$auction->id}}" class="fa fa-heart"></i>
                </a>
            </div>
        @else
            <div>
                <a style="font-size: 15px"
                   class="favorite-btn"
                   id="{{"toggle".$auction->id}}"
                   onclick="toggleFavorite({{$auction->id}}, '{{$auction->isFavourite(Auth::user())}}')">
                    Add to favorites :
                    <i id="{{"heart-icon".$auction->id}}" class="fa fa-heart-o"></i>
                </a>
            </div>
        @endif
    @endif

</div>
