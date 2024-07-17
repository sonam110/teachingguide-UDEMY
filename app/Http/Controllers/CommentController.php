<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function __autoload()
    {

    }

    public function index()
    {

    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request, $post_id)
    {
        $this->validate($request, array(
            'comment'   =>  'required|min:5|max:2000'
        ));

        $user = Auth()->user();

        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->post_id = (int) $post_id;
        $comment->user_id = $user->id;
        $comment->save();

        return redirect('/post/'.$post_id);
    }

}
