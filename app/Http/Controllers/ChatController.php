<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $pelanggan = Message::where('receiver_id', Auth::id())
            ->select('sender_id')
            ->groupBy('sender_id')
            ->with('sender')
            ->get();
        $data = [
            'title' => 'Chat Pelanggan',
            'pelanggan' => $pelanggan
        ];
        return view('admin.chat.index', $data);
    }
    public function fetchMessages($receiverId)
    {
        $messages = Message::with(['sender', 'receiver'])->where(function ($query) use ($receiverId) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $receiverId);
        })
            ->orWhere(function ($query) use ($receiverId) {
                $query->where('sender_id', $receiverId)
                    ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255'
        ]);

        // Check if there are unread messages from the authenticated user
        $check_read = Message::where('sender_id', $request->receiver_id)
            ->where('receiver_id', Auth::id())
            ->where('is_read', 0);

        // Create and send the new message
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        // Update unread messages as read
        if ($check_read->count() > 0) {
            $check_read->update(['is_read' => 1]);
        }

        return response()->json($message);
    }
    public function chatCount($receiverId)
    {
        $check_read = Message::where('sender_id', $receiverId)
            ->where('receiver_id', Auth::id())
            ->where('is_read', 0)->count();

        return response()->json($check_read);
    }
    public function chaAllCount()
    {
        $check_read = Message::where('receiver_id', Auth::id())
            ->where('is_read', 0)->count();

        return response()->json($check_read);
    }
}
