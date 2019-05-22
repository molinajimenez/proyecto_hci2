<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posts = Post::all();

        return view('home')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (!$request->title || !$request->content ||
            !$request->userId) {

                return response()->json([
                    'success' => false,
                    'message' => 'Error en petición al servidor.'
                ], 400);
        }

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = $request->userId;
        $post->save();

        return response()->json([
            'success' => true,
            'message' => 'Post creado con éxito.'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post) {
        $post->comments;
        
        return response()->json([
            'success' => true,
            'post' => $post
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post) {
        if (!$request->title || !$request->content) {

                return response()->json([
                    'success' => false,
                    'message' => 'Error en petición al servidor.'
                ], 400);
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        return response()->json([
            'success' => true,
            'message' => 'Post actualizado con éxito.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post) {
        $post::destroy();

        return response()->json([
            'success' => true,
            'message' => 'Post eliminado con éxito.'
        ], 200);
    }
}
