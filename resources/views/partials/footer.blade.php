<head>
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
</head>

<footer>
    <div class="footer-wrapper">
        <div class="line-separator"></div>
        <div class="footer-content">
            <div class="row">
                <div class="col-sm">
                    <a href="#" class="footer-logo">AutoBids</a>
                    <p class="copyright">
                        <small>LBAW 2285</small>
                    </p>
                </div>
                <div class="col-sm">
                    <h6>User</h6>
                    <ul class="list-unstyled links">
                        <li><a href="/user/{{Auth::id()}}">Profile</a></li>
                        <li><a href="/transaction">Transaction</a></li>
                        <li><a href="/{{Auth::id()}}/requests">Requests</a></li>

                    </ul>
                </div>
                <div class="col-sm">
                    <h6>Auctions</h6>
                    <ul class="list-unstyled links">
                        <li><a href="/auctions/create">Create Auction</a></li>
                        <li><a href="/auctions">Active Auctions</a></li>
                        <li><a href="/auctions/favourites">Favourites</a></li>
                        <li><a href="/my-auctions">My Auctions</a></li>
                    </ul>
                </div>
                <div class="col-sm">
                    <h6>Other Information</h6>
                    <ul class="list-unstyled links">
                        <li><a href="/about">About us</a></li>
                        <li><a href="/faq">FAQ</a></li>
                    </ul>
                </div>


            </div>
        </div>
    </div>
</footer>
