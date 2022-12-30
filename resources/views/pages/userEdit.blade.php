@extends('layouts.default')
@section('content')
    <head>
        <link href="{{ asset('css/signup.css') }}" rel="stylesheet">
    </head>
    <div class="signup-title">
        <h1 style="text-align: center;">Edit Profile</h1>
    </div>
    <div class="form form-wrapper">
        <form method="POST" action="{{ route('user-edit') }}" id="register-form">
            {{ csrf_field() }}
            <div class="form-name">
                <label for="nameForm" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name-form" value={{ $user->name ?? old('name') }} autofocus>
            </div>
            <div class="form-email">
                <label for="emailForm" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email-form" value={{ $user->email ?? old('email') }}>
            </div>
            <div class="form-password">
                <label for="passwordForm" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password-form" placeholder="Password">
            </div>
            <div class="form-password">
                <label for="passwordForm" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="password-form" placeholder="Repeat password">
            </div>
            <div class="form-address">
                <label for="addressForm" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" id="address-form" value={{ $user->address ?? old('address') }}>
            </div>

            <div class="button-wrapper">
                <button class="btn btn-outline-danger" type="submit">
                    Submit
                </button>
            </div>
        </form>

        {{--    TODO: Handle error messages--}}
    </div>
@stop
