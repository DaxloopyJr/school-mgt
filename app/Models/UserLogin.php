<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model
{
    protected $table = 'user_logins';

    protected $fillable = ['user_id', 'ip', 'user_agent', 'logged_in_at'];

    protected $casts = ['pinned' => 'boolean', 'submitted_at' => 'datetime', 'read_at' => 'datetime', 'logged_in_at' => 'datetime'];

    public function user() { return $this->belongsTo(User::class, 'user_id'); }
}
