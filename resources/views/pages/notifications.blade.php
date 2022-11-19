@extends('layouts.default')
@section('content')
    @foreach($user->notifications as $notification)
        <h1>{{$notification}}</h1>
    @endforeach
@stop
