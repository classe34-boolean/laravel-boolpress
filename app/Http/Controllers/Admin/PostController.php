<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    private $postValidationArray = [
        'title' => 'required|max:255',
        'content' => 'required',
        'category_id' => 'nullable|exists:categories,id',
        'tags' => 'exists:tags,id',
        'cover' => 'nullable|image|max:2048'
    ];

    private function generateSlug($data) {
        $slug = Str::slug($data["title"], '-'); // titolo-articolo-3

        $existingPost = Post::where('slug', $slug)->first();
        // dd($existingPost);

        $slugBase = $slug;
        $counter = 1;

        while($existingPost) {
            // blocco di istruzioni
            $slug = $slugBase . "-" . $counter;

            // istruzioni per terminare il ciclo
            $existingPost = Post::where('slug', $slug)->first(); // titolo-articolo-3-2
            $counter++;
        }

        return $slug;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::paginate(5);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate($this->postValidationArray);

        // creazione e salvataggio nuova istanza di classe Post
        $newPost = new Post();

        $slug = $this->generateSlug($data);
        // $newPost->title = $data["title"];
        // $newPost->content = $data["content"];

        // upload cover file
        if(array_key_exists('cover', $data)) {
            // versione in 2 passaggi
            // $img_path = Storage::put('post_covers', $data["cover"]);
            // // sovrascrivo l'oggetto di classe UploadedFile con il nome del file restituito dalla put
            // $data["cover"] = $img_path;

            // per fare operazioni di upload/cancellazione su disco diverso da quello di default
            // $data["cover"] = Storage::disk('public')->put('post_covers', $data["cover"]);

            $data["cover"] = Storage::put('post_covers', $data["cover"]);

        }

        $data['slug'] = $slug;
        $newPost->fill($data); // aggiungiamo $fillable nel Model (Post)

        $newPost->save();

        if(array_key_exists('tags', $data)) {
            // $newPost->tags()->sync($data["tags"]);
            $newPost->tags()->attach($data["tags"]);
        }

        return redirect()->route('admin.posts.show', $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // $post = Post::findOrFail($id);

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        // versione estesa (alternativa al compact())    
        // [
        //     'post' => $post,
        //     'categories' => $categories,
        //     'tags' => $tags 
        // ]

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();
        
        // validazione
        $request->validate($this->postValidationArray);

        if($post->title != $data["title"]) {
            $slug = $this->generateSlug($data);

            $data["slug"] = $slug;
        }

        if(array_key_exists('cover', $data)) {
            if($post->cover) {
                Storage::delete($post->cover);
            }

            $data["cover"] = Storage::put('post_covers', $data["cover"]);
        }

        $post->update($data); // $fillable nel Model

        if(array_key_exists('tags', $data)) {
            $post->tags()->sync($data["tags"]);
        } else {
            // $post->tags->sync([]);
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // in alternativa alla onDelete('CASCADE') delle foreign key nella tabella pivot 
        // $post->tags()->detach();

        if($post->cover) {
            Storage::delete($post->cover);
        }

        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('deleted', $post->title);
    }
}
