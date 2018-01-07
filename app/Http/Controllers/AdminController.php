<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Topic;
use App\User;
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

        $latestUsers = User::getLatestUsers();
        $latestTopics = Topic::getLatestTopics();

        $usersCount = User::count();
        $topicsCount = Topic::count();
        $categoriesCount = Category::count();
        $postsCount = Post::count();

    	return view('admins.index', [
            'topicsCount' => $topicsCount,
            'usersCount' => $usersCount,
            'categoriesCount' => $categoriesCount,
            'postsCount' => $postsCount,
    		'unapprovedTopicsCount' => $unapprovedTopicsCount,
            'unapprovedPostsCount' => $unapprovedPostsCount,
            'latestUsers' => $latestUsers,
            'latestTopics' => $latestTopics
    	]);
    }

}
