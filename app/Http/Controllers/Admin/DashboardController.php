<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Topic;
use App\User;

class DashboardController extends Controller
{
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

        return view('admin.dashboard.index', [
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
