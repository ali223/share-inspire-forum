<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $category->loadApprovedTopicsAndAllByUser(
                    auth()->check() ? auth()->id() : null
                );

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

        return redirect()
            ->route('topics.index', $category)
            ->withMessage('New topic created successfully - waiting for approval by website admin');
    }
}
