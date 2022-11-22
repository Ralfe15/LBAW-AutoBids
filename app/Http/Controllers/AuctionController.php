<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Brand;
use App\Models\Card;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\User;
use App\Notifications\EndAuctionNotification;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
        $this->authorize('list', Card::class);
        $auctions = Auth::user()->auctions()->orderBy('id')->get();
        return view('pages.my_auctions', ['auctions' => $auctions]);
    }

    public function all(Request $request)
    {
        if (!$request->has('search')) {
            $auctions = Auction::where('active', true)->get();
        } else {
            $auctions = Auction::whereRelation('model', 'name', 'ilike', '%' . $request->input('search') . '%')
                ->distinct()->get();
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
            'duration' => 'required|integer',
            'year' => 'required|integer|digits:4',
            'mileage' => 'required|integer',
            'displacement' => 'required|integer',
            'vin' => 'alpha_num|required|size:17',
            'power' => 'required|integer',
            'color' => 'required|string|max:32'
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
        $auction = new Auction();
        $auction->id_category = $request->input('id_Category');
        $auction->id_model = $request->input('id_Model');
        $auction->starting_bid = $request->input('starting_bid') * 100;
        $auction->description = $request->input('description');
        $auction->duration = $request->input('duration');
        $auction->year = $request->input('year');
        $auction->mileage = $request->input('mileage');
        $auction->displacement = $request->input('displacement');
        $auction->vin = $request->input('vin');
        $auction->power = $request->input('power');
        $auction->color = $request->input('color');
        $auction->id_member = $id;

        $auction->save();

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
            //end date is handled as a pgsql trigger
            $auction->save();
            return redirect('/admin');

        }
    }
}
