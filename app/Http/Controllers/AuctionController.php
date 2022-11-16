<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Card;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{

    /**
     * Shows the card for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $auction = Auction::find($id);
        return view('pages.auction', ['auction' => $auction]);
    }

    /**
     * Shows all auctions.
     *
     * @return Response
     */
    public function list()
    {
        if (!Auth::check()) return redirect('/login');
        $this->authorize('list', Card::class);
        $auctions = Auth::user()->auctions()->orderBy('id')->get();
        return view('pages.my_auctions', ['auctions' => $auctions]);
    }
    public function all()
    {
        $auctions = Auction::where('active', true)->get();
        return view('pages.auctions', ['auctions' => $auctions]);
    }
}
