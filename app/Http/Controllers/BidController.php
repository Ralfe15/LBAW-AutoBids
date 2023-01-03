<?php

namespace App\Http\Controllers;



use App\Models\Auction;
use App\Models\Bid;
use App\Models\User;
use App\Notifications\NewBidAuctionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BidController extends Controller
{
    /**
     * Get a validator for an incoming bid request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'bid' => 'required|numeric|min:'.$data['minimum'],
            'prev_id' => 'required|integer',
        ]);
    }

    public function create(Request $request, $id){
        if(!Auth::check()){
            redirect('/home');
        }
        $prevbids = Bid::where('id_auction', $id)->get();

        $bid = new Bid();
        $bid->id_auction = $id;
        $bid->value = $request->input('bid')*100;
        $bid->id_member = Auth::id();
        //decrement before saving the bid in case of negative creds
        Auth::user()->decrement('credits', $bid->value);
        $bid->save();
        $notification = new NewBidAuctionNotification(Auction::find($id), $bid->value);
        if(!$prevbids->isEmpty()) {
            User::find($request->input('prev_id'))->increment('credits', $request->input('prev_bid') * 100);
            foreach ($prevbids as $prevbid){
                //notify other bidders that there has been a new bid
                $prevbid->user->notify($notification);
                (new TestController)->sendEmail($prevbid->user->email, $notification);
            }
        }
        //notify owner about the new bid
        $user = Auction::find($id)->user;
        $user->notify($notification);
        (new TestController)->sendEmail($user, $notification);


        return redirect(route('detail', ['id'=>$id]));

    }



}
