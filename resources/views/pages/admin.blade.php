@extends('layouts.default')
@section('content')
    <head>
        <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    </head>
    <div class="content-wrapper">
        <div class="admin-title">
            <h3>Admin Dashboard</h3>
        </div>
        <div class="admin-button">
            <a href="/admin-requests" class="btn btn-outline-danger">Auction Requests</a>
        </div>
        <div class="admin-button">
            <a href="/admin-reports" class="btn btn-outline-danger">Auction Reports</a>
        </div>
        <div class="admin-button">
            <a href="/admin-transactions" class="btn btn-outline-danger">Transaction Requests</a>
        </div>




    </div>
@stop


