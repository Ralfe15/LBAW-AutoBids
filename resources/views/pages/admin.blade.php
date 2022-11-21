@extends('layouts.default')
@section('content')
    <head>
        <link rel="stylesheet" href="{{asset('css/user.css')}}">
    </head>

    <div class="content-wrapper">
        <h1>Auction creation requests</h1>
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
            @each('partials/auction_admin', $requests, 'auction')
            </tbody>
        </table>
        <h1>Auction reports</h1>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th scope="col">Auction id</th>
                <th scope="col">Auction name</th>
                <th scope="col">Created at</th>
                <th scope="col">Starting bid</th>
                <th scope="col">Owner</th>
                <th scope="col">Duration</th>
            </tr>
            </thead>
            <tbody>
            @each('partials/auction_admin', $requests, 'auction')
            </tbody>
        </table>
    </div>
@stop


