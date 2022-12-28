<div class="card">
{{--    button redirecting to /auctions/{id}--}}
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
            <p>{{ $auction->remaining() }}</p>


        </div>
    </a>
{{--   TODO favourite btn logic--}}
{{--    <?php  if(isset($_SESSION['id'])){--}}
{{--    if($isfav == 'false'){ ?>--}}
{{--    <a class="favorite-btn" id =<?="toggle".$restaurant['idRestaurant']?> onclick="toggleFavorite('<?= $restaurant['idRestaurant'] ?>', '<?= $isfav ?>')">Add to favorites : <i id="heart-icon<?=$restaurant['idRestaurant']?>"class="fa fa-heart-o" aria-hidden="true"></i></a>--}}
{{--    <?php }?>--}}
{{--        <?php if($isfav == 'true'){ ?>--}}
{{--    <a class="favorite-btn" id =<?="toggle".$restaurant['idRestaurant']?> onclick="toggleFavorite('<?= $restaurant['idRestaurant'] ?>', '<?= $isfav ?>')">Remove from favorites : <i id="heart-icon<?=$restaurant['idRestaurant']?>"class="fa fa-heart" aria-hidden="true"></i></a>--}}
{{--    <?php }}?>--}}
{{--    </a>--}}
</div>
