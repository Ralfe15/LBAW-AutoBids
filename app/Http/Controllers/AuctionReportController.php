<?php

namespace App\Http\Controllers;


use App\Models\Auction;
use App\Models\AuctionReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuctionReportController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'id_member' => 'required|exists:App\Models\User,id',
            'id_auction' => 'required|exists:App\Models\Auction,id',
        ]);
    }
    public function markAsSolved(Request $request){

        if(Auth::check() && Auth::user()->is_admin){
            DB::table('reportauction')->where('id_member', $request->input('id_member'))
                ->where('id_auction', $request->input('id_auction'))
                ->update(['solved' => true]);
                return redirect('/admin');
        }
    }
}
