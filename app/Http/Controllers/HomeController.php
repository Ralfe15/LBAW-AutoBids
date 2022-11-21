<?php

namespace App\Http\Controllers;


use App\Models\Auction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function show() {
        return view("pages.default");
    }
}
