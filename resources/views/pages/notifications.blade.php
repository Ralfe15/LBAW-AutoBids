@extends('layouts.default')
@section('content')
    <div class="content-wrapper m-4">
    <h1 class="m-4">Unread notifications</h1>
        <ul class="list-group">
            @foreach($unreadNotifications as $notification)
                <li class="list-group-item">
                    <p>{{processNotification($notification)}}</p>
                    <a class="btn btn-secondary" href="{{route('readnotification', ['id'=>$notification->id])}}">Mark as read</a>
                </li>
            @endforeach
        </ul>
        {{$unreadNotifications->links('pagination::bootstrap-5')}}
        <h1 class="m-4">Past notifications</h1>
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
