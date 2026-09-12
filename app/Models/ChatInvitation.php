<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatInvitation extends Model
{
    protected $table = 'chat_invitations';

    protected $fillable = ['from_user_id', 'to_user_id', 'status'];

    protected $casts = ['pinned' => 'boolean', 'submitted_at' => 'datetime', 'read_at' => 'datetime', 'logged_in_at' => 'datetime'];

    public function fromUser() { return $this->belongsTo(User::class, 'from_user_id'); }
    public function toUser() { return $this->belongsTo(User::class, 'to_user_id'); }
}
