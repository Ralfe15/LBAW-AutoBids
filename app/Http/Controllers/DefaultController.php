<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Support\Facades\Auth;

class DefaultController extends Controller
{

    public function show() {
        return view("pages.default");
    }
}
