<?php

namespace App\Http\Controllers;

use App\ChatMessage;
use App\Events\NewChatMessage;
use App\Http\Resources\ChatMessageResource;
use Illuminate\Http\Request;

class ChatMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $chatMessages = ChatMessage::with('user:id,name')->get();
        $chatMessages = ChatMessageResource::collection($chatMessages);

        return view('chat-messages.index', compact('chatMessages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required'
        ]);

        $chatMessage = ChatMessage::create([
            'text' => $request->text,
            'user_id' => auth()->id()
        ]);

        broadcast(new NewChatMessage($chatMessage))->toOthers();

        return new ChatMessageResource($chatMessage);
    }
}
