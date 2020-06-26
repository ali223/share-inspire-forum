<?php

namespace App\Http\Controllers;

use App\Events\NewPostCreated;
use App\Events\PostDeleted;
use App\Events\PostUpdated;
use App\Http\Resources\PostResource;
use App\Http\Resources\TopicResource;
use App\Post;
use App\Topic;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Topic $topic)
    {
        $approvalMessage = '';

        if (! $topic->approved) {
            if (! ($topic->user_id == auth()->id())) {
                return redirect()->route('home');
            }

            $approvalMessage = 'Waiting for Admin Approval';
        }

        $topic->load([
            'category',
            'posts.likes',
            'posts.user'
        ]);

        $topic = new TopicResource($topic);

        return view('posts.index', [
            'topic' => $topic,
            'approvalMessage' => $approvalMessage
        ]);
    }

    public function latest()
    {
        $latestPosts = Post::with(['user', 'topic'])
                            ->belongingToApprovedTopic()
                            ->latest()
                            ->take(5)
                            ->get();

        return view('posts.latest', compact('latestPosts'));
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

        $post = $topic->addPost(
                    $request->content,
                    auth()->id()
                );

        broadcast(new NewPostCreated($post))->toOthers();

        $post->load('user');

        return new PostResource($post);
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

        broadcast(new PostUpdated($post))->toOthers();

        $post->load('user');

        return new PostResource($post);
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

        $postId = $post->id;

        $post->delete();

        broadcast(new PostDeleted($postId))->toOthers();

        return response()->json([
            'message' => 'The post has been deleted successfully'
        ], 200);
    }
}
