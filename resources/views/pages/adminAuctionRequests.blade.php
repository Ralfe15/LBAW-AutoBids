@extends('layouts.default')
@section('content')
    <head>
        <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    </head>
<div class="content-wrapper">
    <div class="navigation-section">
        <a href="#" class="requests-link">Auction Requests</a>
        <a href="/admin-reports" class="reports-link">Auction Reports</a>
        <a href="/admin-transactions" class="transactions-link">Transaction Requests</a>
    </div>

    <div class="separator">
        <hr class="line">
    </div>

    <div class="title">
        <h3>Auction Requests</h3>
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
        @each('partials/auction_admin', $requests, 'auction')
        </tbody>
    </table>
        <div class="paginator">
            {{$requests->links("pagination::bootstrap-5")}}
        </div>
    </div>
</div>

@stop
