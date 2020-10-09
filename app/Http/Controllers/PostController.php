<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::orderBy('updated_at', 'desc')->get();
        return view('posts.index', ["posts" => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $slug = Str::slug(
            date("Ymd") . "-" . Str::limit($request->title, 55),
            "-"
        );

        $validator = Validator::make($request->all(), [
            "title" => "required|unique:posts|max:255",
            "slug" => "unique",
            "description" => "required"
        ]);

        if ($validator->fails()) {
            return redirect()->route('posts.create')
                ->withErrors($validator)
                ->withInput();
        }

        $published = $request->published ? true : false;

        // Get User ID
        // 1.
        //   use Illuminate\Support\Facades\Auth;
        //   Auth::id()
        // 2.
        //   $request->user()->id;
        // 3.
        //   auth()->user()->id;

        $post = Post::create([
            "user_id" => auth()->user()->id,
            "title" => $request->title,
            "slug" => $slug,
            "description" => $request->description,
            "image" => $request->image,
            "published" => $published,
        ]);

        return redirect()->route('posts.show', $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return view('posts.show', ["post" => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        return view('posts.edit', ["post" => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //

        if ($post->user_id != auth()->user()->id) {
            return redirect()->route('posts.edit', $post->slug)->withErrors(['No Permission', 'You have no permission to edit posts from ' . $post->user->name]);
        }

        $slug = Str::slug(
            date("Ymd") . "-" . Str::limit($request->title, 55),
            "-"
        );

        // $validatedData = $request->validate([
        //     "title" => ["required", Rule::unique('posts')->ignore($post->id), "max:255"],
        //     "slug" => [Rule::unique('posts')->ignore($post->id)],
        //     "description" => "required"
        // ]);

        $validator = Validator::make($request->all(), [
            "title" => ["required", Rule::unique('posts')->ignore($post->id), "max:255"],
            "slug" => [Rule::unique('posts')->ignore($post->id)],
            "description" => "required"
        ]);

        if ($validator->fails()) {
            return redirect()->route('posts.edit', $post->slug)
                ->withErrors($validator)
                ->withInput();
        }


        $published = $request->published ? true : false;

        $post->title = $request->title;
        $post->slug = $slug;
        $post->description = $request->description;
        $post->published = $published;
        $post->image = $request->image;
        $post->save();

        return redirect()->route('posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        if ($post->user_id != auth()->user()->id) {
            return redirect()->route('posts.edit', $post->slug)->withErrors(['No Permission', 'You have no permission to delete posts from ' . $post->user->name]);
        }

        $post->delete();
        return redirect()->route('posts.index');
    }
}
