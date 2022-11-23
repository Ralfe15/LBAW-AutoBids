<?php

namespace App\Http\Controllers;


use App\Models\Auction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function show() {
        $auctions_latest =  Auction::where('active', true)->orderBy('start_date', 'desc')->paginate(5);
        $auctions_finishing =  Auction::where('active', true)->orderBy('end_date', 'desc')->paginate(5);
        $auctions_popular =  Auction::where('active', true)->orderBy('number_bids', 'desc')->paginate(5);
        return view("pages.default", ['auctions_latest' => $auctions_latest, 'auctions_finishing' => $auctions_finishing, 'auctions_popular' => $auctions_popular]);
    }
}
