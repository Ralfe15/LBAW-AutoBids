@extends('layouts.default')
@section('content')
    <head>
        <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    </head>
    <div class="content-wrapper">
        <div class="navigation-section">
            <a href="/admin-requests" class="requests-link">Auction Requests</a>
            <a href="/admin-reports" class="reports-link">Auction Reports</a>
            <a href="#" class="transactions-link">Transaction Requests</a>
        </div>

        <div class="separator">
            <hr class="line">
        </div>

        <div class="title">
            <h3>Transaction Requests</h3>
        </div>
        <div class="table-box">
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
            <div class="paginator">
                {{$banktransfers_approval->links("pagination::bootstrap-5")}}
            </div>
        </div>
    </div>
@stop
