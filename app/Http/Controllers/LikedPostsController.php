<?php

namespace App\Http\Controllers;

use App\Post;

class LikedPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $likedPosts = Post::getPostsLikedByUser(auth()->id());

        return view('liked-posts.index', compact('likedPosts'));
    }
}
