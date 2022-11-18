<?php

namespace App\Http\Controllers;



use App\Models\Bid;
use App\Models\User;
use Illuminate\Http\Request;
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
        $bid = new Bid();
        $bid->id_auction = $id;
        $bid->value = $request->input('bid')*100;
        $bid->id_member = Auth::id();
        $bid->save();
        User::find($request->input('prev_id'))->increment('credits', $request->input('prev_bid')*100);
        Auth::user()->decrement('credits', $bid->value);

    }

}
