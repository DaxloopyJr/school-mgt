<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'avatar', 'status',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool     { return $this->role === 'admin'; }
    public function isTeacher(): bool   { return $this->role === 'teacher'; }
    public function isStudent(): bool   { return $this->role === 'student'; }
    public function isParent(): bool    { return $this->role === 'parent'; }
    public function isAccountant(): bool{ return $this->role === 'accountant'; }

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id');
    }

    public function children()
    {
        return $this->hasMany(Student::class, 'parent_id');
    }

    public function staff()
    {
        return $this->hasOne(Staff::class, 'user_id');
    }

    public function avatarUrl(): string
    {
        return $this->avatar
            ? asset('storage/' . $this->avatar)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=4e73df&color=fff';
    }
}
