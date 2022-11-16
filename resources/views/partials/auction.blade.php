<div class="card">
{{--    button redirecting to /auctions/{id}--}}
    <a href="{{route('detail', ['id'=> $auction->id]) }}">
        <img src='https://picsum.photos/200/200?business?id='>
        <div class="container">
            <h4><b>{{$auction->model->brand->name}} {{$auction->model->name }} - {{ $auction->year }}</b></h4>
            <p>Category: {{$auction->category->name}}</p>
            <p>Rating: {{$auction->rating}}</p>
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
