<?php

namespace App\Http\Controllers;


use App\Models\Auction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function show() {
        $auctions_latest =  Auction::orderBy('start_date', 'desc')->paginate(5);
        $auctions_finishing =  Auction::orderBy('end_date', 'desc')->paginate(5);
        $auctions_popular =  Auction::orderBy('number_bids', 'desc')->paginate(5);
        
        return view("pages.default", ['auctions_latest' => $auctions_latest, 'auctions_finishing' => $auctions_finishing, 'auctions_popular' => $auctions_popular]);
    }
}
