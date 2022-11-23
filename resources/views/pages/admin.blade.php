@extends('layouts.default')
@section('content')
    <head>
        <link rel="stylesheet" href="{{asset('css/user.css')}}">
    </head>
    {{ info($transactions)}}
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
                <th scope="col">Reported by</th>
                <th scope="col">Auction name</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            @each('partials/reports_admin', $reports, 'report')
            </tbody>
        </table>

        <h1>Transaction requests</h1>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Requested by</th>
                <th scope="col">Profile</th>
                <th scope="col">Type</th>
                <th scope="col">Value</th>
            </tr>
            </thead>
            <tbody>
            @each('partials/transactions', $banktransfers_approval, 'transaction')
            </tbody>
        </table>
    </div>
@stop


