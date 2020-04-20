<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);

        return view('posts.index' , compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PostRequest  $request
     * @return \Illuminate\Http\PostRequest
     */
    public function store(PostRequest $request)
    {
        // dd($request->all());
        // save
        $post = Post::create([
                'user_id' => auth()->user()->id
            ] + $request->all()
        );

        // Image
        if ($request->file('image')){
            $post->image = $request->file('image')->store('posts', 'public');
            $post->save();
        }


        // return
        return back()->with('status', 'Post saved successfuly!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    // public function show(Post $post)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());

        // Image
        if ($request->file('image')){
            // Eliminar imagen en public
            Storage::disk('public')->delete($post->image);

            // Save the neww image
            $post->image = $request->file('image')->store('posts', 'public');
            $post->save();
        }

        return back()->with('status', 'Post updated successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Eliminar imagen en public
        Storage::disk('public')->delete($post->image);
        $post->delete();

        return back()->with('status', 'Article deleted successfuly!!');
    }
}