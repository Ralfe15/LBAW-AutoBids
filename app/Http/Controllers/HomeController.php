<?php

namespace App\Http\Controllers;


use App\Models\Auction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function show() {
        $auctions_latest =  Auction::where('active', true)->where('approved', true)->orderBy('start_date', 'desc')->paginate(10);
        $auctions_finishing =  Auction::where('active', true)->where('approved', true)->orderBy('end_date', 'desc')->paginate(10);
        $auctions_popular =  Auction::where('active', true)->where('approved', true)->orderBy('number_bids', 'desc')->paginate(10);

        return view("pages.newhome", ['auctions_latest' => $auctions_latest, 'auctions_finishing' => $auctions_finishing, 'auctions_popular' => $auctions_popular]);
    }

    public function showFAQ() {
        return view("pages.faq");
    }

    public function showAbout() {
        return view("pages.about");
    }
}
