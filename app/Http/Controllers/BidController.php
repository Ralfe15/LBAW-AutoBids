<?php

namespace App\Http\Controllers;



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

        ]);
    }

    public function makeBid(Request $request){
        if(!Auth::check()){
            redirect('/home');
        }

        $this->validator($request->all())->validate();

           }
}
