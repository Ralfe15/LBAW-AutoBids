<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Comment;
use App\Models\User;
use App\Notifications\NewCommentNotification;
use App\Notifications\NewReplyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'id_auction' => 'required|integer',
            'id_comment' => 'integer|nullable',
            'content' => 'required|string',
        ]);
    }
    public function auctionComments($id)
    {
        $auction = Auction::find($id);
        $comments = $auction->comments()->whereNull('id_comment')->get();


        return view('partials.auctionComments', ['auction'=> $auction->id, 'comments' => $comments]);
    }

    public function createComment(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $this->validator($request->all())->validate();

        $comment = new Comment();
        $comment->id_auction = $request->input('id_auction');
        $comment->id_member = Auth::id();
        $comment->id_comment = $request->input('id_comment');
        $comment->content = $request->input('content');
        $comment->save();

        $user = User::find(Auth::id());
        $auction = Auction::find($comment->id_auction);

        //is a reply
        if($comment->id_comment){
            //from auction owner only notify parent
            $notification = new NewReplyNotification($auction);
            $user = Comment::find($comment->id_comment)->user;
            $user->notify($notification);
            (new TestController)->sendEmail($user->email, $notification);
            //notify both
            if($comment->id_member != $auction->id_member){
                $notification = new NewReplyNotification($auction);
                $auction->user->notify($notification);
                (new TestController)->sendEmail($auction->user->email, $notification);
            }
        }
        //is main comment, notify owner
        elseif($comment->id_member != $auction->id_member){
            $notification = new NewCommentNotification($auction);
            $auction->user->notify($notification);
            (new TestController)->sendEmail($auction->user->email, $notification);
        }


        return redirect("/auction/$comment->id_auction");
    }

    public function showCommentForm($id, $parent = null) {
        if (!Auth::check()) {
            return redirect('/login');
        }
        return view('pages.commentCreate', ['auction_id'=>$id, 'parent' => $parent]);
    }


}
