<div class="user">
        <a href="{{route('user_profile', ['id'=> $user->id]) }}">
            <img src='https://picsum.photos/200/200?business?id='>
            <div class="container">
                <h4><b>{{$user->name}}</b></h4>
                <p>Rating: {{$user->rating}}</p>
            </div>
        </a>
</div>