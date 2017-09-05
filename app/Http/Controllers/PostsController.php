<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Topic;

class PostsController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'update', 'destroy'] ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Topic $topic)
    {

        // using Lazy Eager loading to retrieve all the related topics in one go 
        // and then pass to the views. This prevents n+1 query problem

        $approvalMessage = "";

        if(! ($topic->approved)) {   
            if(!($topic->user_id == auth()->id())) {
                 return redirect()->route('home');
            } 

            $approvalMessage = "Waiting for Admin Approval";           

        }
            

        $topic->load(['posts', 'posts.user']);

        if(request()->expectsJson()) {
            return $topic;
        }

        return view('posts.index', [
            'topic' => $topic,
            'approvalMessage' => $approvalMessage
        ]);
        
    }

    public function latest()
    {
        $latestPosts =  Post::with(['user', 'topic'])
                        ->withTopicApproved()        
                        ->latest()
                        ->take(5)
                        ->get();       

        return view('posts.latest', compact('latestPosts'));
        
    }

    public function search()
    {
        $keywords = request()->input('keywords');

        $keywords = explode(' ', $keywords);       

        $searchedPosts = Post::with(['user', 'topic'])
                        ->withTopicApproved()
                        ->searchContent($keywords)
                        ->get();

        return view('posts.search', [ 'searchedPosts' => $searchedPosts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Topic $topic)
    {
        $topic->load('category');
        return view('posts.create', compact('topic'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Topic $topic)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        $post = new Post;
        $post->content = $request->content;
        $post->user_id = auth()->user()->id;

        $topic->posts()->save($post);

        if($request->expectsJson()) {
            return $post->load('user');
        }

        return redirect()
                ->route('posts.index', $topic->id)
                ->with('message', 'New Post Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic, Post $post)
    {
        $this->authorize('update', $post);

        $post->content = $request->content;

        $topic->posts()->save($post);

        return response()->json(['new_content' => $post->content], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic, Post $post)
    {
        $this->authorize('update', $post);
        
        $post->delete();

        return response()->json(['message' => 'The post has been deleted successfully'], 200);

    }
}
