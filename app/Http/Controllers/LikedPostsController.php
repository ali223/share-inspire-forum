<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class LikedPostsController extends Controller
{
    /**
     * Create a new LikedPostsController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $likedPosts = Post::getPostsLikedByUser(auth()->id());

        return view('likedposts.index', compact('likedPosts'));
    }
}
