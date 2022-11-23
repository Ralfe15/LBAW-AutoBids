<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchAuction(Request $request)
    {
        info($search = $request->input('search'));
        $search = $request->input('search');

        $auctions = Auction::select('auction.*')
            ->join('category','category.id','=','id_category')
            ->join('model', 'model.id', '=', 'id_model')
            ->join('brand', 'brand.id', '=', 'id_brand')
            ->where('category.name', 'ilike', '%'.$search.'%')          //category
            ->orWhere('model.name', 'ilike', '%'.$search.'%')           //model
            ->orWhere('brand.name', 'ilike', '%'.$search.'%')           //brand
            ->orwhere('color','ilike','%'.$search.'%')                  //color
            ->orWhere('description','ilike','%'.$search.'%')->get();    //description

        return view('pages.auctions', ['auctions'=>$auctions]);
    }
}
