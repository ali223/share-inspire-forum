<?php

namespace App\Http\Controllers;

use App\ChatMessage;
use App\Events\NewChatMessage;
use Illuminate\Http\Request;

class ChatMessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return ChatMessage::with('user')->get();
        }

        return view('chatmessages.index');
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

        return $chatMessage;
    }

}
