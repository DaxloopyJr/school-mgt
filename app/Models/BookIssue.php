<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    protected $table = 'book_issues';

    protected $fillable = [
        'book_id',
        'library_member_id',
        'issue_date',
        'due_date',
        'returned_at',
        'fine',
        'status',
    ];

    protected $casts = ['issue_date' => 'date', 'due_date' => 'date', 'returned_at' => 'date', 'fine' => 'decimal:2'];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function libraryMember()
    {
        return $this->belongsTo(LibraryMember::class, 'library_member_id');
    }
}
