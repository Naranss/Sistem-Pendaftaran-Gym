<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\ChatMessage;
use App\Events\ChatMessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Daftar room chat user (member/trainer)
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'TRAINER') {
            $rooms = ChatRoom::where('trainer_id', $user->id)->with('member')->get();
        } else if ($user->role === 'MEMBER') {
            $rooms = ChatRoom::where('member_id', $user->id)->with('trainer')->get();
        } else {
            $rooms = collect();
        }
        return view('chat.index', compact('rooms'));
    }

    // Tampilkan room chat tertentu
    public function show($roomId)
    {
        $room = ChatRoom::with(['messages.sender', 'trainer', 'member'])->findOrFail($roomId);
        $user = Auth::user();

        // Cek akses
        if (
            ($user->role === 'TRAINER' && $room->trainer_id !== $user->id) ||
            ($user->role === 'MEMBER' && $room->member_id !== $user->id)
        ) {
            abort(403);
        }

        return view('chat.room', compact('room'));
    }

<<<<<<< HEAD
    // Kirim pesan ke room
    public function send(Request $request, $roomId)
=======
    // Get messages as JSON (untuk AJAX)
    public function getMessages($roomId)
>>>>>>> cc2d019606d1050d7861c7be7080f0d40cddc1c9
    {
        $room = ChatRoom::with('messages.sender')->findOrFail($roomId);
        $user = Auth::user();

<<<<<<< HEAD
=======
        // Authorization
        if (
            ($user->role == 'TRAINER' && $room->trainer_id != $user->id) ||
            ($user->role == 'MEMBER' && $room->member_id != $user->id)
        ) {
            abort(403);
        }

        $messages = $room->messages->map(function ($msg) {
            return [
                'id' => $msg->id,
                'sender_id' => $msg->sender_id,
                'sender_name' => $msg->sender->nama,
                'message' => $msg->message,
                'time' => $msg->created_at->format('H:i d-m-Y'),
                'created_at' => $msg->created_at,
            ];
        });

        return response()->json([
            'messages' => $messages
        ]);
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

>>>>>>> cc2d019606d1050d7861c7be7080f0d40cddc1c9
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = \App\Models\ChatMessage::create([
            'chat_room_id' => $room->id,
            'sender_id' => $user->id,
            'message' => $request->message,
        ]);

<<<<<<< HEAD
        broadcast(new ChatMessageSent($message->load('sender')))->toOthers();

        return response()->json([
            'status' => 'ok',
            'message' => $message
=======
        broadcast(new \App\Events\ChatMessageSent($message->load('sender')))->toOthers();

        return response()->json([
            'status' => 'ok',
            'message' => [
                'sender_name' => $user->nama,
                'message' => $message->message,
                'created_at' => $message->created_at->format('H:i d-m-Y H:i'),
                'sender_id' => $user->id,
            ]
>>>>>>> cc2d019606d1050d7861c7be7080f0d40cddc1c9
        ]);
    }
}
