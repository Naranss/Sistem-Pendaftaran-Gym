<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\ChatMessage;
use App\Events\ChatMessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // List chat rooms for current user
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'TRAINER') {
            $rooms = ChatRoom::where('trainer_id', $user->id)->with('member')->get();
        } else if ($user->role == 'MEMBER') {
            $rooms = ChatRoom::where('member_id', $user->id)->with('trainer')->get();
        } else {
            $rooms = [];
        }
        return view('chat.index', compact('rooms'));
    }

    // Show chat room
    public function show($roomId)
    {
        $room = ChatRoom::with('messages.sender')->findOrFail($roomId);
        $user = Auth::user();

        // Authorization: trainer/member only
        if (
            ($user->role == 'TRAINER' && $room->trainer_id != $user->id) ||
            ($user->role == 'MEMBER' && $room->member_id != $user->id)
        ) {
            abort(403);
        }

        return view('chat.room', compact('room'));
    }

    // Send message (AJAX/POST)

    public function send(Request $request, $roomId)
    {
        $room = \App\Models\ChatRoom::findOrFail($roomId);
        $user = Auth::user();

        if (
            ($user->role === 'TRAINER' && $room->trainer_id !== $user->id) ||
            ($user->role === 'MEMBER' && $room->member_id !== $user->id)
        ) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = \App\Models\ChatMessage::create([
            'chat_room_id' => $room->id,
            'sender_id' => $user->id,
            'message' => $request->message,
        ]);

        // Broadcast ke orang lain
        broadcast(new \App\Events\ChatMessageSent($message->load('sender')))->toOthers();

        // Return pesan yang baru saja dikirim ke pengirim
        return response()->json([
            'status' => 'ok',
            'message' => [
                'id' => $message->id,
                'chat_room_id' => $message->chat_room_id,
                'sender_id' => (string)$user->id,
                'sender_name' => $user->nama,
                'message' => $message->message,
                'created_at' => $message->created_at->format('H:i d-m-Y'),
            ]
        ]);
    }
}
