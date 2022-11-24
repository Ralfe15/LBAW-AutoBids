@extends('layouts.default')
@section('content')
<head>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<div class="login-title">
    <h1 style="text-align: center;">Login </h1>
</div>

<div class="form">
    <form action="{{ route('login') }}" method="post">
        {{ csrf_field() }}
        <div class="form-email">
            <label for="emailForm" class="form-label">Email</label>
            <input required type="email" class="form-control" name="email" id="email-form" placeholder="Email">
        </div>
        <div class="form-password">
            <label for="passwordForm" class="form-label">Password</label>
            <input required type="password" class="form-control" name="password" id="password-form" placeholder="Password">
        </div>
        <div class="button-wrapper">
            <button type="submit" class="btn btn-secondary">Login</button>
        </div>

    </form>
    {{--    TODO: Handle error messages--}}
</div>
@stop


