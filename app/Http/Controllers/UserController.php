<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionReport;
use App\Models\BankTransfer;
use App\Models\Paypal;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Card;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Shows the user profile for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $user = User::find($id);
      return view('pages.user', ['user' => $user]);
    }

    public function list()
    {
      $users = User::all();
      return view('pages.users', ['users' => $users]);
    }

    public function notifications($id){
        if(Auth::check() && Auth::id() == $id){
            $user = User::find($id);
            return view('pages.notifications', ['user' => $user]);
        }
        return view('pages.home');
    }

    public function adminDashboard()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $requests = Auction::where('approved', false)->orderBy('creation_date', 'asc')->get();
            $reports = AuctionReport::where('solved',false)->orderBy('date', 'asc')->get();
            $banktransfers_approval = BankTransfer::where('approved', false)->orderBy('id')->get();
            $paypal = Paypal::orderBy('id')->get();
            $banktransfers = BankTransfer::orderBy('id')->get();
            $transactions = $banktransfers->merge($paypal);


            return view('pages.admin', [
                'requests'=>$requests,
                'reports'=>$reports,
                'transactions'=>$transactions,
                'banktransfers_approval' =>$banktransfers_approval
            ]);
        }
        return view('pages.home');
    }
}
