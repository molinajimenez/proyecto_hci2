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
    public function show(Request $request) {
        
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
    public function edit(Request $request) {
        $cosa = $request->id;
        $cosaUser = $request->usuario;
        //aqui hay condicion and..
        $toUpdate = Post::where('id', $cosa)->where('user_id', $cosaUser)->first();
        
        //jalado del objeto
       
        $toUpdate->title = $request->titulo;
        $toUpdate->content = $request->contenido;
        $toUpdate->save();

        
       return response()->json([
        'updated' => 'success',
        'updated_post' => $toUpdate,
    ], 200);
        
    }

    public function findAll(Request $request){
       $posts = Post::all();

       return response()->json([
            'posts' => $posts,
        ], 200);


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
        //
    }
}
