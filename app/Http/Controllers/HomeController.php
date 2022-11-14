<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{

    public function show() {
        $table = User::all();
        return view("pages.home", ["users"=>$table]);
    }
}
