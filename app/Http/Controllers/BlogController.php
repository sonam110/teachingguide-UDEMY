<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function __autoload()
    {

    }

    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('articles.list_articles')->withPosts($posts);
    }

    public function getSingle($slug)
    {
    	$post = Post::where('slug', '=', $slug)->first();
    	return view('articles.show')->withPost($post);
    }

}
