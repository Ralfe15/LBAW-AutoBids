@extends('layouts.default')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/notifications.css') }}" >
    <div class="content-wrapper m-4">
    <h3 class="m-4">Unread notifications</h3>
        <ul class="list-group">
            @foreach($unreadNotifications as $notification)
                <li class="list-group-item">
                    <p>{{processNotification($notification)}}</p>
                    @if($notification->type == "App\Notifications\EndAuctionNotificationBids" && $notification->data['winner_id'] == Auth::id())
                        <form method="POST" action="{{route('rate', ["id"=>$notification->data['auction_id']])}}">
                            {{ csrf_field() }}
                            <div class="star-rating">
                                <input type="radio" id="5-stars" name="rating" value="5" />
                                <label for="5-stars" class="star">&#9733;</label>
                                <input type="radio" id="4-stars" name="rating" value="4" />
                                <label for="4-stars" class="star">&#9733;</label>
                                <input type="radio" id="3-stars" name="rating" value="3" />
                                <label for="3-stars" class="star">&#9733;</label>
                                <input type="radio" id="2-stars" name="rating" value="2" />
                                <label for="2-stars" class="star">&#9733;</label>
                                <input type="radio" id="1-star" name="rating" value="1" />
                                <label for="1-star" class="star">&#9733;</label>
                                <input type="radio" id="0-star" name="rating" value="0" checked='checked' style='display:none' />
                                <input type="hidden" name="notification_id" value="{{$notification->id}}"/>
                            </div>
                            <div class="text-wrapper">
                                <button type="submit" class="btn btn-outline-danger">Rate seller</button>
                            </div>
                        </form>
                    @else
                        <a class="btn btn-outline-danger" href="{{route('readnotification', ['id'=>$notification->id])}}">Mark as read</a>
                    @endif
                </li>
            @endforeach
        </ul>
        {{$unreadNotifications->links('pagination::bootstrap-5')}}
        <h3 class="m-4">Past notifications</h3>
        <ul class="list-group">
            @foreach($readNotifications as $notification)
                <li class="list-group-item">
                    <p>{{processNotification($notification)}}</p>
                </li>
            @endforeach
        </ul>
        {{$readNotifications->links('pagination::bootstrap-5')}}

    </div>

@stop
