<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Card;
use App\Models\User;
use App\Notifications\EndAuctionNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuctionController extends Controller
{

    public function show($id)
    {
        $auction = Auction::find($id);
        if(!$auction->active){
            return redirect('/home');
        }
        $time_remaining = Carbon::parse($auction->end_date)->longAbsoluteDiffForHumans(Carbon::now(), 6 );
        $current_bid_val = $auction->bids->max('value');
        $can_bid = true;
        if(is_null($current_bid_val)){
            $current_bid = ($auction->starting_bid)/100; //starting price
            $current_bid_user_id = -1;
            if ($auction->id_member == Auth::id()){
                $can_bid = false;
            }
        }
        else{
            $current_bid = Bid::where('value', '=', $current_bid_val)->get();
            if(($current_bid[0]->id_member == Auth::id()) || ($auction->id_member == Auth::id())){
                $can_bid = false;
            }
            $current_bid_user_id = $current_bid[0]->id_member;
            $current_bid = $current_bid_val/100;
        }


        return view('pages.auction', ['auction' => $auction, 'time_remaining' => $time_remaining,
            'current_bid' => $current_bid, 'can_bid' =>$can_bid, 'prev_id'=>$current_bid_user_id]);
    }

    public function list()
    {
        if (!Auth::check()) return redirect('/login');
        $this->authorize('list', Card::class);
        $auctions = Auth::user()->auctions()->orderBy('id')->get();
        return view('pages.my_auctions', ['auctions' => $auctions]);
    }
    public function all(Request $request)
    {
        if(!$request->has('search')){
            $auctions = Auction::where('active', true)->get();
        }
        else{
            $auctions = Auction::whereRelation('model', 'name', 'ilike', '%'.$request->input('search').'%')
                ->distinct()->get();
        }
        return view('pages.auctions', ['auctions' => $auctions]);

    }

    public function checkEnd() {
        $active_auctions = Auction::where('active', true)
            ->where('approved', true)
            ->get();
        foreach ($active_auctions as $auction){
            // if we are in a time ahead of end_date
            if(!Carbon::parse($auction->end_date)->diff(Carbon::now())->invert){
                $auction->active = false;
                $auction->save();

                //notify the auction winner and the owner about the result
                $winner = $auction->winner();
                $notification = new EndAuctionNotification($auction, $winner);
                $winner->notify($notification);
                $auction[0]->user()->notify($notification);
            }
        }
        echo "Updated auctions and notified owner/winner";
    }

}
