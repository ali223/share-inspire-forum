<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicsSearchController extends Controller
{
    public function index(Request $request)
    {
        $keywords = $request->input('keywords');

        $searchedTopics = Topic::search($keywords)->get();
        
        return view('topics.search', [
            'searchedTopics' => $searchedTopics
        ]);     
    }
}
