<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Category;
use App\Post;

class TopicsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store'] ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id)
    {

        // using Eager loading to retrieve all the related topics in one go 
        // and then pass to the views. This prevents n+1 query problem

        $category = Category::with(
            ['topics' => function($query) {
                $query->where('approved', 1)
                      ->orWhere('user_id', auth()->id());
            }] 
        )->find($category_id);

                
        return view('topics.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {

        return view('topics.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        $category->addTopic(
            $request->title, 
            $request->content,
            auth()->id()
        );

        return redirect()->route('topics.index', $category->id)
        ->withMessage('New topic created successfully - waiting for approval by website admin');
    }
    
}
