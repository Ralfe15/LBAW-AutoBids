@extends('layouts.default')
@section('content')
    <head>
        <link href="{{ asset('css/notifications.css') }}" rel="stylesheet">
    </head>
    <div class="content-wrapper m-4">
    <h1 class="m-4">Unread notifications</h1>
        <ul class="list-group">
            @foreach($user->unreadNotifications as $notification)
                <li class="list-group-item">
                    <p>{{processNotification($notification)}}</p>
                    <a class="btn btn-secondary" href="{{route('readnotification', ['id'=>$notification->id])}}">Mark as read</a>
                </li>
            @endforeach
        </ul>
        <h1 class="m-4">Past notifications</h1>
        <ul class="list-group">
            @foreach($user->readNotifications as $notification)
                <li class="list-group-item">
                    <p>{{processNotification($notification)}}</p>
                </li>
            @endforeach
        </ul>
    </div>

@stop
