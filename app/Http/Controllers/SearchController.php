<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function searchAuction(Request $request)
    {
        info($search = $request->input('search'));
        $search = $request->input('search');
        $fts = DB::select(DB::raw("SELECT id , ts_rank(tsvectors, query) AS rank FROM auction,
        plainto_tsquery('english',:search) query WHERE tsvectors @@ query ORDER BY rank DESC;"), array('search' => $search));
        $ids = array();
        foreach ($fts as $item) {
            array_push($ids, $item->id);
        }
        $auctions = Auction::whereIn('id', $ids)->paginate(5);

        return view('pages.auctions', ['auctions' => $auctions]);
    }
}
