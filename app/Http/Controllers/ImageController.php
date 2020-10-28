<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $validated = $request->validate([
                    'name' => 'string',
                    'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg',
                ]);
                // $ext = $request->image->extension();
                $name = Str::lower(
                    time() . "-" . $request->image->getClientOriginalName()
                );
                $path = '/img/blog/';
                $url = $path . $name;
                $request->image->move(public_path($path), $name);

                $image = Image::create([
                    'url' => $url,
                ]);

                $image->posts()->sync($request->post_id);

                return response()->json([
                    'success' => 'Image uploaded!!',
                    'url' => $url,
                    'image' => $image,
                    'post_id' => $request->post_id,
                    'file' => $request->hasFile('image'),
                    'valid' => $request->file('image')->isValid(),
                ]);
            }
            return response('Invalid image uploaded', 403);
        }
        return response('No image uploaded', 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
