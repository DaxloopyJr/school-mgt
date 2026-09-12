<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'title',
        'book_no',
        'isbn',
        'book_category_id',
        'author',
        'publisher',
        'quantity',
        'price',
        'rack_no',
    ];

    protected $casts = ['price' => 'decimal:2'];

    public function bookCategory()
    {
        return $this->belongsTo(BookCategory::class, 'book_category_id');
    }
}
