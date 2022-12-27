<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionReport;
use App\Models\Bid;
use App\Models\Brand;
use App\Models\Card;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\Image;
use App\Models\User;
use App\Notifications\AbortedAuctionNotificationBids;
use App\Notifications\AbortedAuctionNotificationNoBids;
use App\Notifications\ApprovedAuctionNotification;
use App\Notifications\DeniedAuctionNotification;
use App\Notifications\EndAuctionNotificationBids;
use App\Notifications\EndAuctionNotificationNoBids;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuctionController extends Controller
{

    public function show($id)
    {
        $auction = Auction::find($id);
        if (!$auction->active) {
            return redirect('/home');
        }
        $time_remaining = Carbon::parse($auction->end_date)->longAbsoluteDiffForHumans(Carbon::now(), 6);
        $current_bid_val = $auction->bids->max('value');
        $can_bid = true;
        if (is_null($current_bid_val)) {
            $current_bid = ($auction->starting_bid) / 100; //starting price
            $current_bid_user_id = -1; //check for this flag in the notification
            if ($auction->id_member == Auth::id()) {
                $can_bid = false;
            }
        } else {
            $current_bid = Bid::where('value', '=', $current_bid_val)->get();
            if (($current_bid[0]->id_member == Auth::id()) || ($auction->id_member == Auth::id())) {
                $can_bid = false;
            }
            $current_bid_user_id = $current_bid[0]->id_member;
            $current_bid = $current_bid_val / 100;
        }
        $prev_bids = $auction->bids()->orderBy('date', 'desc')->get();

        return view('pages.auction', ['auction' => $auction, 'time_remaining' => $time_remaining,
            'current_bid' => $current_bid, 'can_bid' => $can_bid, 'prev_id' => $current_bid_user_id, 'prev_bids' => $prev_bids]);
    }

    public function list()
    {
        if (!Auth::check()) return redirect('/login');
        $auctions = Auth::user()->auctions()->orderBy('id')->get();
        return view('pages.my_auctions', ['auctions' => $auctions]);
    }

    public function all(Request $request)
    {
        if (!$request->has('search')) {
            $auctions = Auction::where('active', true)->paginate(5);
        } else {
            $auctions = Auction::whereRelation('model', 'name', 'ilike', '%' . $request->input('search') . '%')
                ->distinct()->paginate(5);
        }
        return view('pages.auctions', ['auctions' => $auctions]);

    }

    public function checkEnd()
    {
        $active_auctions = Auction::where('active', true)
            ->where('approved', true)
            ->get();

        foreach ($active_auctions as $auction) {
            // if we are in a time ahead of end_date
            if (!Carbon::parse($auction->end_date)->diff(Carbon::now())->invert) {
                //notify the auction winner and the owner about the result
                $winner = $auction->winner();
                if (!is_null($winner)) {
                    $notification = new EndAuctionNotificationBids($auction, $winner);
                    $winner->user->notify($notification);
                } else {
                    // Case an auction ends without any bid
                    $notification = new EndAuctionNotificationNoBids($auction);
                }

                $auction->user->notify($notification);
                $auction->active = false;
                $auction->save();
            }
        }
        echo "Updated auctions and notified owner/winner";
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'id_Category' => 'required|integer',
            'id_Model' => 'required|integer',
            'starting_bid' => 'required|integer',
            'description' => 'required|string',
            'd' => 'required|integer',
            'h' => 'required|integer',
            'm' => 'required|integer',
            's' => 'required|integer',
            'year' => 'required|integer|digits:4',
            'mileage' => 'required|integer',
            'displacement' => 'required|integer',
            'vin' => 'alpha_num|required|size:17',
            'power' => 'required|integer',
            'color' => 'required|string|max:32',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    }

    /**
     * Create a new auction instance after validation
     *
     */

    public function create(Request $request)
    {
        $this->validator($request->all())->validate();
        if (!Auth::check()) {
            redirect('/home');
        }
        $id = Auth::user()->id;

        //Auction
        $auction = new Auction();
        $auction->id_category = $request->input('id_Category');
        $auction->id_model = $request->input('id_Model');
        $auction->starting_bid = $request->input('starting_bid') * 100;
        $auction->description = $request->input('description');
        $auction->duration = dateToSeconds($request->input('d'), $request->input('h'),
            $request->input('m'), $request->input('s'));
        $auction->year = $request->input('year');
        $auction->mileage = $request->input('mileage');
        $auction->displacement = $request->input('displacement');
        $auction->vin = $request->input('vin');
        $auction->power = $request->input('power');
        $auction->color = $request->input('color');
        $auction->id_member = $id;
        $auction->save();

        //Images
        if ($request->images) {
            foreach ($request->images as $key => $image) {
                $newImage = new Image();
                $imageName = $auction->id . '-' . $key . '.' . $image->extension();
                $imagePath = "img/auctions/$auction->id/";
                $image->move(public_path($imagePath), $imageName);
                $imageFullPath = $imagePath . $imageName;

                $newImage->path = $imageFullPath;
                $newImage->id_auction = $auction->id;
                $newImage->save();
            }
        }


        //change redirect to auction details
        return redirect('/home');
    }

    public function showAuctionForm()
    {
        if (!Auth::check()) {
            return redirect('/home');
        }
        $car_models = CarModel::all()->sortBy('name');
        $car_brands = Brand::all()->sortBy('name');
        $categories = Category::all()->sortBy('name');
        return view('pages.auctionCreate', ['auction' => null, 'categories' => $categories, 'car_models' => $car_models, 'car_brands' => $car_brands]);
    }

    public function approve($id)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $auction = Auction::find($id);
            $auction->approved = true;
            $auction->active = true;
            $auction->start_date = now();
            $auction->end_date = now()->addSeconds($auction->duration);
            $auction->save();
            $auction->user->notify(new ApprovedAuctionNotification($auction));
            return redirect('/admin');

        }
    }

    public function deny($id)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $auction = Auction::find($id);
            $auction->user->notify(new DeniedAuctionNotification($auction));
            $auction->delete();
            return redirect('/admin');
        }
    }

    public function abort(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $auction = Auction::find($id);
            if (is_null($auction->winner())) {
                $notification = new AbortedAuctionNotificationNoBids($auction);
                $auction->user->notify($notification);
            } else {
                $notification = new AbortedAuctionNotificationBids($auction, $auction->winner());
                $auction->winner()->user->increment('credits', $auction->winner()->value);
                $auction->winner()->user->notify($notification);
                $auction->user->notify($notification);
                DB::table('reportauction')->where('id_member', $request->input('id_member'))
                    ->where('id_auction', $request->input('id_auction'))
                    ->update(['solved' => true]);
            }
            $auction->aborted = true;
            $auction->active = false;
            $auction->approved = false;
            $auction->save();
            return redirect('/admin');
        }
    }

    public function cancel($id)
    {
        $auction = Auction::find($id);
        if (Auth::check() && (Auth::id() == $auction->id_member)) {
            $auction->delete();
            return redirect('/' . Auth::id() . '/requests');
        }
        return redirect('/home');
    }
}
