<?php

namespace App\Http\Controllers;

use App\Post;

class LikesController extends Controller
{
    public function store(Post $post)
    {
        $this->authorize('like', $post);

        $post->markAsLikedBy(auth()->id());
    }

    public function destroy(Post $post)
    {
        $post->markAsUnlikedBy(auth()->id());
    }
}
