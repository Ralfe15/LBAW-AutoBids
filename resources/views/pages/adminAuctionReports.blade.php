@extends('layouts.default')
@section('content')
    <head>
        <link rel="stylesheet" href="{{asset('css/admin.css')}}">
        <title>Admin Auction Reports</title>
    </head>
    <div class="content-wrapper">
        <div class="navigation-section">
            <a href="/admin-requests" class="requests-link">Auction Requests</a>
            <a href="#" class="reports-link">Auction Reports</a>
            <a href="/admin-transactions" class="transactions-link">Transaction Requests</a>
        </div>

        <div class="separator">
            <hr class="line">
        </div>

        <div class="title">
            <h3>Auction Reports</h3>
        </div>
        <div class="table-box">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th scope="col">Reported by</th>
                <th scope="col">Auction name</th>
                <th scope="col">Date</th>
                <th scope="col">Description</th>

            </tr>
            </thead>
            <tbody>
            @each('partials/reports_admin', $reports, 'report')
            </tbody>
        </table>
            <div class="paginator">
                {{$reports->links("pagination::bootstrap-5")}}
            </div>
        </div>
    </div>
    @stop
