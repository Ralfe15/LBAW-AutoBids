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
        return redirect('/home');
    }
    public function showReportForm($id) {
        if (!Auth::check()) {
            return redirect('/login');
        }
        return view('pages.reportCreate', ['auction_id'=>$id]);
    }

    public function createReport(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $this->validator($request->all())->validate();

        $report = new AuctionReport();
        $report->id_auction = $request->input('id_auction');
        $report->id_member = Auth::id();
        $report->description = $request->input('content');
        $report->save();
        return redirect("/auction/$report->id_auction");
        }
}
