@extends('layouts.default')
@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
    <title>Profile</title>
</head>

<div class="content-wrapper">
    <div class="user-image-wrapper">
        <div class="user-image">
           {{-- @if($user->image->isEmpty()) --}}
                <img src="{{ asset('img/users/profile_placeholder.png') }}" alt="profile picture">
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
            <p><b>Member since: </b> {{$user->since()}}</p>
        </div>
    </div>
    @if(Auth::id() == $user->id)
        <div class="button-wrapper">
            <a class="btn btn-outline-danger btn-lg" href="{{route('user_edit')}}">
                Edit Profile
            </a>
        </div>
    @endif


</div>



@stop


