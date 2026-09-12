<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatBlockedUser extends Model
{
    protected $table = 'chat_blocked_users';

    protected $fillable = ['user_id', 'blocked_user_id'];

    protected $casts = ['pinned' => 'boolean', 'submitted_at' => 'datetime', 'read_at' => 'datetime', 'logged_in_at' => 'datetime'];

    public function blockedUser() { return $this->belongsTo(User::class, 'blocked_user_id'); }
}
