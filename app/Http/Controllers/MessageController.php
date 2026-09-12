<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $me = $request->user();
        $inbox = Message::with('sender')->where('receiver_id', $me->id)->latest()->paginate(15);
        $sent = Message::with('receiver')->where('sender_id', $me->id)->latest()->paginate(15);
        $users = User::where('id', '!=', $me->id)->where('status', 'active')->orderBy('name')->pluck('name', 'id');
        return view('messages.index', compact('inbox', 'sent', 'users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'subject'     => 'required|string|max:255',
            'message'     => 'required|string|max:5000',
        ]);
        $data['sender_id'] = $request->user()->id;
        Message::create($data);
        return back()->with('success', 'Message sent.');
    }

    public function read(Request $request, $id)
    {
        $msg = Message::where('receiver_id', $request->user()->id)->findOrFail($id);
        $msg->update(['read_at' => now()]);
        return back();
    }
}
