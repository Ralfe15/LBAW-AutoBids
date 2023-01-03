<head>
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
</head>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('home')}}"><img src="{{ asset('/img/autobids_logo.png') }}" alt="AutoBids Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="{{route('auctions')}}" role="button" aria-haspopup="true" aria-expanded="false"><i class="bi bi-car-front"></i>&ensp;Auctions</a>
                        <div class="dropdown-menu" id="auction-dropdown">
                            <a class="dropdown-item" href="{{route('auctions')}}"><i class="bi bi-car-front"></i>&emsp;Active Auctions</a>
                            <a class="dropdown-item" href="{{route('my_auctions')}}"><i class="bi bi-person-vcard"></i>&emsp;My Auctions</a>
                            <a class="dropdown-item" href="{{route('favourites')}}"><i class="bi bi-heart"></i>&emsp;Favourites</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('create_auction')}}"><i class="bi bi-patch-plus"></i>&emsp;Create Auction</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href={{ route('faq') }}><i class="bi bi-question-circle"></i>&ensp;FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href={{ route('about') }}><i class="bi bi-info-circle"></i>&ensp;About</a>
                    </li>


                </ul>
                <div class="nav-item">
                    <form action="{{ route('search-auction') }}" class="navbar-search" method="POST">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search..." aria-label="Search Bar" aria-describedby="button-addon2" name="search" id="search">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav ms-auto" id="account-dropdown">
                    @if(Auth::check())
                    <li class="nav-item icon-notification">
                        <a class="nav-link" href="{{route('notifications', ['id'=>Auth::id()])}}">
                            <i class="bi bi-bell"></i>
                            @if(Auth::user()->unreadNotifications->count() > 0)
                                <span class="badge bg-danger rounded-pill">{{ Auth::user()->unreadNotifications->count() }}</span>
                            @endif
                        </a>
                    </li>
                    @endif
                    <li class="nav-item dropdown" >

                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="bi bi-person-circle"></i>&ensp;
                            @if(Auth::check())
                                {{ Auth::user()->getUsername() }}
                            @else
                                Account
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            @if(Auth::check())
                                <a class="dropdown-item" href="{{route('create_transaction')}}"><i class="bi bi-currency-exchange"></i>&emsp;Balance: U${{credits_format(Auth::user()->credits/100)}}</a>
                                <a class="dropdown-item" href="/user/{{ Auth::user()->id }}"><i class="bi bi-person-circle"></i>&emsp;Profile</a>
                                <a class="dropdown-item" href="{{route('requests', ['id'=>Auth::id()])}}"><i class="bi bi-card-list"></i>&emsp;Auction Requests</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout"><i class="bi bi-box-arrow-right"></i>&emsp;Logout</a>
                                @if(Auth::user()->is_admin)
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('admin_dashboard')}}"><i class="bi bi-tools"></i>&emsp;Admin dashboard</a>
                                @endif
                            @else
                                <a class="dropdown-item" href="{{route('register')}}"><i class="bi bi-person-add"></i>&emsp;Sign Up</a>
                                <a class="dropdown-item" href="{{route('login')}}"><i class="bi bi-box-arrow-in-right"></i>&emsp;Login</a>
                            @endif
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
