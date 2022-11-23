<header>
    <div class="defaultheader-wrapper">
        <div class="headerLogo">
        <a href="/home">
            <img src="{{ asset('img/logo.png') }}" alt="AutoBids" />
        </a>

        </div>
        <div class="search-div">
            <form action="../pages/search.php" class="search" method="POST">
                <input type="text" placeholder="Search.." name="search">
                <input type="text" class="search-type" name="search-type" style="display:none" value="restaurant">
                <button type="submit" class="search-button"><i></i>&#x276F</button>
            </form>
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
        </div>


        <div class="dropdownAccount">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownAccountButton" data-bs-toggle="dropdown" aria-expanded="false">
                Account
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownAccountButton">
                @if(Auth::check())
                    <li><a class="dropdown-item" href="#">Balance: U${{credits_format(Auth::user()->credits/100)}}</a></li>
                    <li><a class="dropdown-item" href="/user/{{ Auth::user()->id }}">Profile</a></li>
                    <li><a class="dropdown-item" href="{{route('notifications', ['id'=>Auth::id()])}}">Notifications ({{ Auth::user()->unreadNotifications->count() }})</a></li>
                    <li><a class="dropdown-item" href="/my-auctions">My Auctions</a></li>
                    <li><a class="dropdown-item" href="#">Favourites</a></li>
                    <li><a class="dropdown-item" href="/auctions/create">Create Auction</a></li>
                    <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    @if(Auth::user()->is_admin)
                        <li><a class="dropdown-item" href="{{route('admin_dashboard')}}">Admin dashboard</a></li>
                    @endif
                @else
                    <li><a class="dropdown-item" href="{{route('register')}}">Sign Up</a></li>
                    <li><a class="dropdown-item" href="{{route('login')}}">Login</a></li>
                @endif
            </ul>
        </div>
    </div>

    <div class="header-navbar">
        <a class="nav-home" href="{{ route('home') }}">Home</a>
        <a class="nav-auctions" href="{{ route('auctions') }}">Auctions</a>
        <a class="nav-faq" href="#">FAQ</a>
        <a class="nav-about" href="#">About</a>
    </div>
</header>

