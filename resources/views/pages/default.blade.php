@extends('layouts.default')
@section('content')
@if(Auth::check())
{{--    TODO: Handle these endpoints--}}
<div class="button-wrapper">
    <a class="central-button" href='{{route('my_auctions')}}'>Your owned auctions</a>
    <a class="central-button" href=''>Your favorite auctions</a>
    <a class="central-button" href='{{route('auctions')}}'>View active auctions</a>
</div>
@endif
@stop
