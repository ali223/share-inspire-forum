<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    public function index()
    {

    	$unapprovedTopicsCount = Topic::unapprovedCount();
    	$unapprovedPostsCount = Post::unapprovedCount();

    	return view('admins.index', [
    		'unapprovedTopicsCount' => $unapprovedTopicsCount,
    		'unapprovedPostsCount' => $unapprovedPostsCount
    	]);
    }
}
