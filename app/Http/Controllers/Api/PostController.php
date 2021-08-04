<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Archivio post
     */
    public function index() {
        // $posts = Post::all();
        $posts = Post::paginate(6);

        $posts->each(function ($post) {
            if($post->cover) {
                $post->cover = url('storage/' . $post->cover);
            } else {
                $post->cover = url('images/placeholder.png');
            }
        });

        // foreach($posts as $post) {
        //     if($post->cover) {
        //         $post->cover = url('storage/' . $post->cover);
        //     } else {
        //         $post->cover = url('images/placeholder.png');
        //     }
        // }

        return response()->json($posts);
    }

    /**
     * Dettaglio post
     */
    public function show($slug) {

        $post = Post::where('slug', $slug)
            ->with(['category', 'tags'])
            ->first(); // EAGER LOADING (in Blade LAZY LOADING)

        if(!empty($post)) {
            if($post->cover) {
                $post->cover = url('storage/' . $post->cover);
            } else {
                $post->cover = url('images/placeholder.png');
            }
        }    

        return response()->json($post);
    }
}
