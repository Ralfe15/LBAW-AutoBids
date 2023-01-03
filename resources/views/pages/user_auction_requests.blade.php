@extends('layouts.default')
@section('content')
    <head>
        <link rel="stylesheet" href="{{asset('css/userRequest.css')}}">
    </head>
    <div class="content-wrapper">
        <div class="title">
        <h3>Auction creation requests</h3>
        </div>
        <div class="table-box">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Created at</th>
                <th scope="col">Starting bid</th>
                <th scope="col">Owner</th>
                <th scope="col">Duration</th>
            </tr>
            </thead>
            <tbody>
            @each('partials/user_auction_request', $requests, 'auction')
            </tbody>
        </table>
        {{$requests->links("pagination::bootstrap-5")}}
        </div>
    </div>
@stop

