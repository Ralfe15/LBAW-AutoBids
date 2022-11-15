@include('partials/header')
<head>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

</head>
<body>
<h1 style="text-align: center;">Sign up</h1>
<div class="form">
    <form method="POST" action="{{ route('register') }}" id="form_login">
        {{ csrf_field() }}
        <p>
            <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="name" required autofocus>
        </p>
        <p>
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="email" required>
        </p>
        <p>
            <input type="password" required name="password" placeholder="password"/>
        </p>
        <p>
            <input type="password" required name="password_confirmation" placeholder="repeat password"/>
        </p>
        <p>
            <input type="tel" required name="phone" placeholder="phone"/>
        </p>
        <p>
            <input type="text" required name="address" placeholder="address"/>
        </p>
        <button type="submit">
            Register
        </button>
    </form>

    {{--    TODO: Handle error messages--}}
</div>

