<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}