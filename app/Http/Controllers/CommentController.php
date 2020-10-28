<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests\StoreBlogComment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        //
        return view('comments.index', [
            "post" => $post,
            "comments" => $post->comments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        //
        return view('comments.create', ["post" => $post]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogComment $request, Post $post)
    {
        //
        $comment = Comment::create([
            "user_id" => $request->user()->id,
            "post_id" => $post->id,
            "title" => $request->title,
            "description" => $request->description,
        ]);

        $request->session()->flash('status', 'Comment successfully posted!');
        return redirect()->route('posts.show', ["post" => $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Comment $comment)
    {
        //
        return view('comments.show', ["post" => $post, "comment" => $comment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Comment $comment)
    {
        //
        return view('comments.edit', ["post" => $post, "comment" => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(
        StoreBlogComment $request,
        Post $post,
        Comment $comment
    ) {
        //
        $comment->title = $request->title;
        $comment->description = $request->description;
        $comment->save();

        return redirect()->route('posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Comment $comment)
    {
        //
        $comment->delete();
        return redirect()->route('posts.show', $post->slug);
    }
}
