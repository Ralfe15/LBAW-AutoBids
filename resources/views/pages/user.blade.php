@extends('layouts.default')
@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
</head>

<div class="content-wrapper">
    <div class="user-image-wrapper">
        <div class="user-image">
           {{-- @if($user->image->isEmpty()) --}}
                <img src="{{ asset('img/users/profile_placeholder.png') }}">
            {{--  @else
                <img src="{{ $user->image->path }}">
              @endif --}}
        </div>
    </div>
    
    <div class="user-details">
        <div class="details-name">
            <p><b>Name: </b> {{$user->name}}</p>
        </div>
        <div class="details-email">
            <p><b>Email: </b> {{$user->email}}</p>
        </div>
        <div class="details-address">
            <p><b>Address: </b> {{$user->address}}</p>
        </div>
        <div class="details-rating">
            <p><b>Rating: </b> {{$user->rating}}</p>
        </div>
        <div class="details-membersince">
            <p><b>Member since: </b> {{$user->account_creation}}</p>
        </div>
    </div>


</div>



@stop


