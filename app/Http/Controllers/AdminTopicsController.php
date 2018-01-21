<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class AdminTopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $topics = Topic::with('category')->get();

        return view('admins.topics.index', [
            'topics' => $topics
        ]);
    }

    public function approve(Topic $topic)
    {
        $topic->approved = 1;
        $topic->save();

        return redirect()->back();
    }

    public function disapprove(Topic $topic)
    {
        $topic->approved = 0;
        $topic->save();

        return redirect()->back();
    }
    
}
