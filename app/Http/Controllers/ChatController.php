<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\NewMessage;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->latest()->take(50)->get()->reverse();
        return view('chat.index', compact('messages'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $message = Message::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        broadcast(new NewMessage($message))->toOthers();

        return response()->json(['status' => 'Message envoyé !']);
    }
}
