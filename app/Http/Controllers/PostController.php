<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\PostTag;
use App\Comment;
use Purifier;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller
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
        $posts = Post::orderBy('id', 'desc')->get();
        return view('articles.index')->withPosts($posts);
    }

    public function list()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('articles.lists')->withPosts($posts);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        ini_set('memory_limit', '256M');

        // validate the data
        $validatedData = $request->validate([
            'title'   => 'required|max:255',
            'slug'    => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'body'    => 'required'
        ]);

        $user = Auth()->user();

        $post = new Post;
        $post->title   = $request->title;
        $post->slug    = $request->slug;
        $post->date    = date('Y-m-d', strtotime($request->date));
        $post->views   = 0;

        $post->user_id = $user->id;

        $dom = new \domdocument();
        $dom->loadHtml($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');



       // foreach <img> in the submited message
        foreach($images as $img){

            $src = $img->getAttribute('src');

            // if the img source is 'data-url'
            if(preg_match('/data:image/', $src)){
                // get the mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);

                $mimetype = $groups['mime'];
                // Generating a random filename
                $filename = uniqid();
                $filepath = "/upload_images/$filename.$mimetype";
                $image = Image::make($src)
                  // resize if required
                  /* ->resize(300, 200) */
                  ->encode($mimetype, 100)  // encode file to the specified mimetype
                  ->save(public_path($filepath));
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            } // <!--endif
        } // <!-

        $request->body = $dom->savehtml();

        $post->body = $request->body;

        $post->save();

        $tagList = explode(',', $request->tags);

        if(is_array($tagList) && !empty($tagList)) {
            foreach($tagList as $k => $tag) {
                $postTag = new PostTag;
                $postTag->post_id = $post->id;
                $postTag->name = $tag;
                $postTag->save();
            }
        }

        return redirect()->route('post.show', $post->id);
    }

    public function show($id)
    {
        $post = Post::find($id);

        $post->views += 1;
        $post->save();

        return view('articles.show')->withPost($post);
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('articles.edit')->withPost($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if ($request->input('slug') == $post->slug) {
            $validatedData = $request->validate([
                'title'   => 'required|max:255',
                'body'    => 'required'
            ]);
        } else {
            $validatedData = $request->validate([
                'title'   => 'required|max:255',
                'slug'    => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'body'    => 'required'
            ]);
        }

        $post->title = $request->input('title');
        $post->slug  = $request->input('slug');
        $post->date  = date('Y-m-d', strtotime($request->date));
        $post->body  = $request->input('body');
        $post->save();

        $postTag = PostTag::where(['post_id' => $id]);
        $postTag->delete();

        $tagList = explode(',', $request->tags);

        if(is_array($tagList) && !empty($tagList)) {
            foreach($tagList as $k => $tag) {
                $postTag = new PostTag;
                $postTag->post_id = $post->id;
                $postTag->name = $tag;
                $postTag->save();
            }
        }

        return redirect()->route('post.show', $post->id);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->delete();
        $post->delete();

        echo json_encode([
            "success" => true,
            "message" => "Post deleted with success"
        ]);
    }

    public function createcomment(Request $request, $post_id)
    {
        echo "<pre>";
        var_dump($request);
        exit;
    }

}
