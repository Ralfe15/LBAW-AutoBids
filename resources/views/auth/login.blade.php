@include('partials/header')
<head>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
<h1 style="text-align: center;">Login </h1>
<div class="form">
    <form action="{{ route('login') }}" method="post">
        <p>
            <input type="text" required name="email" placeholder="email"/>
        </p>
        <p>
            <input type="password" required name="password" placeholder="password"/>
        </p>
        <p>
            <button type="submit">Login</button>
        </p>
    </form>
    {{--    TODO: Handle error messages--}}
</div>

