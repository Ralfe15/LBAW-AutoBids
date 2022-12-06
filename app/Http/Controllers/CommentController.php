<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Comment;
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
            redirect('/login');
        }

        $this->validator($request->all())->validate();

        $comment = new Comment();
        $comment->id_auction = $request->input('id_auction');
        $comment->id_member = Auth::id();
        $comment->id_comment = $request->input('id_comment');
        $comment->content = $request->input('content');
        $comment->save();

        return redirect("/auction/$comment->id_auction");
    }

    public function showCommentForm($id, $parent = null) {
        return view('pages.commentCreate', ['auction_id'=>$id, 'parent' => $parent]);
    }


}
