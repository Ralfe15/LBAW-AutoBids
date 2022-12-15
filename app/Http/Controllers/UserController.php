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
     * @param int $id
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

    public function notifications($id)
    {
        if (Auth::check() && Auth::id() == $id) {
            $user = User::find($id);
            $unread_notifications = $user->unreadNotifications()->paginate(5);
            $read_notifications = $user->readNotifications()->paginate(5);
            return view('pages.notifications', ['user' => $user, 'unreadNotifications' => $unread_notifications,
                'readNotifications' => $read_notifications]);
        }
        return view('pages.home');
    }

    public function requests($id)
    {
        if (Auth::check() && Auth::id() == $id) {
            $user = User::find($id);
            $requests = $user->auctions()->where('approved', false)->orderBy('creation_date', 'asc')->paginate(5, ['*'], 'requests');
            return view('pages.user_auction_requests', ['requests' => $requests]);
        }
        return view('pages.home');
    }

    public function readNotification($id)
    {
        $userUnreadNotification = Auth::user()
            ->unreadNotifications
            ->where('id', $id)
            ->first();

        if ($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
        }
        return back();
    }

    public function adminDashboard()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $requests = Auction::where('approved', false)->orderBy('creation_date', 'asc')->paginate(5, ['*'], 'requests');
            $reports = AuctionReport::where('solved', false)->orderBy('date', 'asc')->paginate(5, ['*'], 'reports');
            $banktransfers_approval = BankTransfer::where('approved', false)->orderBy('id')->paginate(5, ['*'], 'transactions');


            return view('pages.admin', [
                'requests' => $requests,
                'reports' => $reports,
                'banktransfers_approval' => $banktransfers_approval
            ]);
        }
        return view('pages.home');
    }

    public function edit(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $user = User::find($user_id);


            $user->name = $request->name;
            $user->email = $request->email;
            $user->address = $request->address;


            if ($request->password) {
                $password = bcrypt($request->password);
                $user->password = $password;
            }

            $user->save();

            return redirect("/user/$user_id");
        }

        return redirect('/login');
    }

    public function showEditForm()
    {
        if (Auth::check()) {
            $user = User::find(Auth::id());

            return view('pages.userEdit', ['user' => $user]);
        }

        return redirect('/login');
    }
}
