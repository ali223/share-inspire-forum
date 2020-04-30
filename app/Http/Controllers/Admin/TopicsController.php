<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Topic;

class TopicsController extends Controller
{
    public function index()
    {
        $topics = Topic::with('category')->get();

        return view('admin.topics.index', [
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
