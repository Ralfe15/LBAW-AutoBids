@extends('layouts.default')
@section('content')
<head>
    <link href="{{ asset('css/signup.css') }}" rel="stylesheet">
</head>
<div class="signup-title">
    <h1 style="text-align: center;">Sign up</h1>
</div>
<div class="form">
    <form method="POST" action="{{ route('register') }}" id="form_login">
        {{ csrf_field() }}
        <div class="form-name">
            <label for="nameForm" class="form-label">Name</label>
            <input required type="text" class="form-control" name="name" id="name-form" placeholder="Name" autofocus>
        </div>
        <div class="form-email">
            <label for="emailForm" class="form-label">Email</label>
            <input required type="email" class="form-control" name="email" id="email-form" placeholder="Email">
        </div>
        <div class="form-password">
            <label for="passwordForm" class="form-label">Password</label>
            <input required type="password" class="form-control" name="password" id="password-form" placeholder="Password">
        </div>
        <div class="form-password">
            <label for="passwordForm" class="form-label">Confirm Password</label>
            <input required type="password" class="form-control" name="password_confirmation" id="password-form" placeholder="Repeat password">
        </div>
        <div class="form-tel">
            <label for="telForm" class="form-label">Phone</label>
            <input required type="tel" class="form-control" name="phone" id="name-form" placeholder="Phone Number">
        </div>
        <div class="form-address">
            <label for="addressForm" class="form-label">Address</label>
            <input required type="text" class="form-control" name="address" id="address-form" placeholder="Address">
        </div>

        <div class="button-wrapper">
            <button class="btn btn-secondary" type="submit">
                Register
            </button>
        </div>
    </form>

    {{--    TODO: Handle error messages--}}
</div>
@stop
