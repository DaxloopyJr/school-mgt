<?php

namespace App\Http\Controllers;

use App\Models\ChatBlockedUser;
use App\Models\ChatInvitation;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /** Contacts allowed per chat rules */
    protected function contacts(User $me)
    {
        $query = User::where('id', '!=', $me->id)->where('status', 'active');

        switch ($me->role) {
            case 'admin':
            case 'accountant':
                break; // admin can chat without invitation, with anyone
            case 'teacher':
                // teachers chat with admin + parents (parents need accepted invitation)
                $invited = ChatInvitation::where('status', 'accepted')
                    ->where(function ($q) use ($me) {
                        $q->where('from_user_id', $me->id)->orWhere('to_user_id', $me->id);
                    })
                    ->get()->map(fn ($i) => $i->from_user_id == $me->id ? $i->to_user_id : $i->from_user_id);
                $query->where(function ($q) use ($invited) {
                    $q->whereIn('role', ['admin', 'accountant', 'teacher'])->orWhereIn('id', $invited);
                });
                break;
            case 'parent':
                // parents chat with admin + teachers who accepted invitation
                $invited = ChatInvitation::where('status', 'accepted')
                    ->where(function ($q) use ($me) {
                        $q->where('from_user_id', $me->id)->orWhere('to_user_id', $me->id);
                    })
                    ->get()->map(fn ($i) => $i->from_user_id == $me->id ? $i->to_user_id : $i->from_user_id);
                $query->where(function ($q) use ($invited) {
                    $q->whereIn('role', ['admin'])->orWhereIn('id', $invited);
                });
                break;
            case 'student':
                // students can chat with admin & accounts
                $query->whereIn('role', ['admin', 'accountant']);
                break;
        }

        $blocked = ChatBlockedUser::where('user_id', $me->id)->pluck('blocked_user_id');
        return $query->whereNotIn('id', $blocked)->orderBy('name')->get();
    }

    public function index(Request $request)
    {
        $me = $request->user();
        $contacts = $this->contacts($me);
        $active = $request->filled('with') ? User::find($request->get('with')) : $contacts->first();

        $messages = collect();
        if ($active) {
            ChatMessage::where('sender_id', $active->id)->where('receiver_id', $me->id)->whereNull('read_at')->update(['read_at' => now()]);
            $messages = ChatMessage::with('sender')
                ->where(function ($q) use ($me, $active) {
                    $q->where('sender_id', $me->id)->where('receiver_id', $active->id);
                })->orWhere(function ($q) use ($me, $active) {
                    $q->where('sender_id', $active->id)->where('receiver_id', $me->id);
                })->orderBy('created_at')->get();
        }

        $allUsers = $me->role === 'admin' ? collect() : User::where('id', '!=', $me->id)->where('status', 'active')->orderBy('name')->get();
        $pendingInvites = ChatInvitation::with('fromUser')->where('to_user_id', $me->id)->where('status', 'pending')->get();
        $blockedUsers = ChatBlockedUser::with('blockedUser')->where('user_id', $me->id)->get();

        return view('chat.index', compact('contacts', 'active', 'messages', 'allUsers', 'pendingInvites', 'blockedUsers'));
    }

    /** JSON polling endpoint (jQuery) */
    public function fetch(Request $request, $userId)
    {
        $me = $request->user();
        $other = User::findOrFail($userId);
        ChatMessage::where('sender_id', $other->id)->where('receiver_id', $me->id)->whereNull('read_at')->update(['read_at' => now()]);

        $messages = ChatMessage::with('sender')
            ->where(function ($q) use ($me, $other) {
                $q->where('sender_id', $me->id)->where('receiver_id', $other->id);
            })->orWhere(function ($q) use ($me, $other) {
                $q->where('sender_id', $other->id)->where('receiver_id', $me->id);
            })->orderBy('created_at')->get()
            ->map(fn ($m) => [
                'id'      => $m->id,
                'mine'    => $m->sender_id === $me->id,
                'sender'  => $m->sender->name ?? '',
                'message' => $m->message,
                'file'    => $m->file ? asset('storage/' . $m->file) : null,
                'pinned'  => (bool) $m->pinned,
                'time'    => $m->created_at->format('d M H:i'),
            ]);

        return response()->json($messages);
    }

    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message'     => 'nullable|string|max:2000',
            'file'        => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,mp4,mp3|max:10240',
        ]);

        $path = $request->hasFile('file') ? $request->file('file')->store('uploads/chat', 'public') : null;

        ChatMessage::create([
            'sender_id'   => $request->user()->id,
            'receiver_id' => $request->receiver_id,
            'message'     => $request->message,
            'file'        => $path,
        ]);

        return back();
    }

    public function invite(Request $request)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);
        ChatInvitation::firstOrCreate(
            ['from_user_id' => $request->user()->id, 'to_user_id' => $request->user_id],
            ['status' => 'pending']
        );
        return back()->with('success', 'Chat invitation sent.');
    }

    public function respondInvite(Request $request, $id)
    {
        $invite = ChatInvitation::where('to_user_id', $request->user()->id)->findOrFail($id);
        $invite->update(['status' => $request->get('action') === 'accept' ? 'accepted' : 'rejected']);
        return back()->with('success', 'Invitation ' . $invite->status . '.');
    }

    public function block(Request $request)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);
        ChatBlockedUser::firstOrCreate(['user_id' => $request->user()->id, 'blocked_user_id' => $request->user_id]);
        return back()->with('success', 'User blocked.');
    }

    public function unblock(Request $request, $userId)
    {
        ChatBlockedUser::where('user_id', $request->user()->id)->where('blocked_user_id', $userId)->delete();
        return back()->with('success', 'User unblocked.');
    }

    /** Teachers can pin a message to top */
    public function pin(Request $request, $id)
    {
        $message = ChatMessage::findOrFail($id);
        abort_unless(in_array($request->user()->role, ['admin', 'teacher']), 403);
        ChatMessage::where('receiver_id', $message->receiver_id)->where('sender_id', $message->sender_id)->update(['pinned' => false]);
        $message->update(['pinned' => !$message->pinned]);
        return back()->with('success', 'Message pin toggled.');
    }
}
