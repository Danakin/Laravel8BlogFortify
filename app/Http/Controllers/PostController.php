<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
// use Illuminate\Validation\Rule;
// use Illuminate\Support\Facades\Validator;

use App\Http\Requests\StoreBlogPost;
use App\Http\Requests\UpdateBlogPost;

use App\Models\Tag;

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

    public function indexFiltered(Tag $tag)
    {
        $posts = $tag
            ->posts()
            ->orderBy('id', 'desc')
            ->get();
        return view('posts.index', ["posts" => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tag $tags)
    {
        //
        $tags = Tag::orderBy('title')->get();
        return view('posts.create', ["tags" => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
        //
        // $slug = Str::slug(
        //     date("Ymd") . "-" . Str::limit($request->title, 55),
        //     "-"
        // );

        // $validator = Validator::make($request->all(), [
        //     "title" => "required|unique:posts|max:255",
        //     "slug" => "unique",
        //     "description" => "required"
        // ]);

        // $validated = $request->validated([
        //     "title" => "required|unique:posts|max:255",
        //     "slug" => "unique",
        //     "description" => "required"
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->route('posts.create')
        //         ->withErrors($validator)
        //         ->withInput();
        // }

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
            "slug" => $request->slug,
            "description" => $request->description,
            "image" => $request->image,
            "published" => $published,
        ]);

        if ($request->tags > 0) {
            $post->tags()->sync($request->input('tags'));
            // foreach ($request->input('tags') as $tag_id) {
            //     $post->tags->sync($tag_id);
            // }
        }

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
        $tags = Tag::orderBy('title')->get();
        $tag_ids = $post->tags()->allRelatedIds();
        return view('posts.edit', [
            "post" => $post,
            "tags" => $tags,
            "tag_ids" => $tag_ids,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogPost $request, Post $post)
    {
        // $slug = Str::slug(
        //     date("Ymd") . "-" . Str::limit($request->title, 55),
        //     "-"
        // );

        // $validatedData = $request->validate([
        //     "title" => ["required", Rule::unique('posts')->ignore($post->id), "max:255"],
        //     "slug" => [Rule::unique('posts')->ignore($post->id)],
        //     "description" => "required"
        // ]);

        // $validator = Validator::make($request->all(), [
        //     "title" => ["required", Rule::unique('posts')->ignore($post->id), "max:255"],
        //     "slug" => [Rule::unique('posts')->ignore($post->id)],
        //     "description" => "required"
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->route('posts.edit', $post->slug)
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        if (!$request->user()->can('update', $post)) {
            return redirect()
                ->route('posts.edit', $post->slug)
                ->withErrors([
                    'Unauthorized',
                    'You need permission to edit posts by ' . $post->user->name,
                ])
                ->withInput();
        }

        $published = $request->published ? true : false;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->description = $request->description;
        $post->published = $published;
        $post->image = $request->image;
        $post->save();

        if ($request->tags > 0) {
            $post->tags()->sync($request->input('tags'));
        }

        return redirect()->route('posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        //
        // dd($this->authorize('delete', $post)->toArray());
        if (!$request->user()->can('delete', $post)) {
            return redirect()
                ->route('posts.edit', $post->slug)
                ->withErrors([
                    'No Permission',
                    'You have no permission to delete posts from ' .
                    $post->user->name,
                ]);
        }

        $post->delete();
        return redirect()->route('posts.index');
    }
}
