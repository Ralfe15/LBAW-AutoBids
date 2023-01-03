<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">


<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
    <script type="text/javascript" src={{ asset('js/app.js') }} defer>
    </script>
</head>

<body>
<header>
    <div class="header-wrapper">
        <a href="/home" id="return">AutoBids</a>
        @if(Auth::check())
            <div id="register">
                <p>Balance: €{{credits_format(Auth::user()->credits/100)}}</p>
                <a href="/logout" id="signup">Log out</a>
            </div>
        @else
            <div id="register">
                <a href="{{route('register')}}" id="signup">Sign Up</a>
                <a href="{{route('login')}}" id="login">Login</a>
            </div>
        @endif
        {{--        <?php if (isset($_SESSION['id'])) drawLogoutOptions($_SESSION["id"]);--}}
        {{--        else drawLoginOptions();--}}
        {{--        ?>--}}
    </div>
</header>
