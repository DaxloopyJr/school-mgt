<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends CrudController
{
    protected string $model = Book::class;
    protected string $route = 'books';
    protected string $title = 'Book';
    protected array $with = ['bookCategory'];

    protected array $fields = [
            ['name' => 'title', 'label' => 'Book Title', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'book_no', 'label' => 'Book No', 'type' => 'text'],
            ['name' => 'isbn', 'label' => 'ISBN', 'type' => 'text', 'list' => false],
            ['name' => 'book_category_id', 'label' => 'Category', 'type' => 'select', 'options' => \App\Models\BookCategory::class, 'optionLabel' => 'name', 'relation' => 'bookCategory.name'],
            ['name' => 'author', 'label' => 'Author', 'type' => 'text'],
            ['name' => 'publisher', 'label' => 'Publisher', 'type' => 'text', 'list' => false],
            ['name' => 'quantity', 'label' => 'Quantity', 'type' => 'integer', 'required' => true, 'default' => 1],
            ['name' => 'price', 'label' => 'Price', 'type' => 'number'],
            ['name' => 'rack_no', 'label' => 'Rack No', 'type' => 'text', 'list' => false],
    ];
}
