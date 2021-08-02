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

        return response()->json($posts);
    }

    /**
     * Dettaglio post
     */
    public function show($slug) {

        $post = Post::where('slug', $slug)
            ->with(['category', 'tags'])
            ->first(); // EAGER LOADING (in Blade LAZY LOADING)

        return response()->json($post);
    }
}
