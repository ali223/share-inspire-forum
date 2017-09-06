<?php

namespace App\Events;

use App\Post;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewPostCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $postId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($postId)
    {
        $this->postId = $postId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('posts-channel');
    }

    public function broadcastWith()
    {
        $postArray =  Post::with('user')
                ->find($this->postId)
                ->toArray();

        return ['post' => $postArray];
    }
}
