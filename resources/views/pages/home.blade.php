@include('partials/header')

<head>
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
</head>

<body>
<img class="logo-home" src="https://manualdeimagem.up.pt/files/uportonegativofundoopaco.jpg" />
<div class="search-div">
    <form action="../pages/search.php" class="search" method="POST">
        <input type="text" placeholder="Search.." name="search">
        <input type="text" class="search-type" name="search-type" style="display:none" value="restaurant">
        <button type="submit" class="search-button"><i></i>&#x276F</button>
    </form>
</div>
<div class="search-by">
    <span>By:</span>
{{--    TODO  handle ONCLICK function here  --}}
    <input type="radio" name="select" id="option-1" value = "restaurant">
    <input type="radio" name="select" id="option-2" value= "dish">
    <input type="radio" name="select" id="option-3" value= "rating">

    <label for="option-1" class="option option-1" name="restaurant">
        <div class="dot"></div>
        <span>Name</span>
    </label>
    <label for="option-2" class="option option-2" name="dish">
        <div class="dot"></div>
        <span>Price</span>
    </label>
</div>
@if(Auth::check())
{{--    TODO: Handle these endpoints--}}
<div class="button-wrapper">
    <a class="central-button" href=''>Your owned auctions</a>
    <a class="central-button" href=''>Your favorite auctions</a>
    <a class="central-button" href=''>Your bidded auctions</a>
</div>
@endif
</body>
