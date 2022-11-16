<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function show() {
        $table = Auction::where('id_member', Auth::id())->get();
        return view("pages.home", ["users"=>$table]);
    }
}
