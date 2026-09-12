<?php

namespace App\Http\Controllers;

use App\Models\BookIssue;

class BookIssueController extends CrudController
{
    protected string $model = BookIssue::class;
    protected string $route = 'book-issues';
    protected string $title = 'Issue / Return Book';
    protected array $with = ['book', 'libraryMember'];

    protected array $fields = [
            ['name' => 'book_id', 'label' => 'Book', 'type' => 'select', 'required' => true, 'options' => \App\Models\Book::class, 'optionLabel' => 'title', 'relation' => 'book.title'],
            ['name' => 'library_member_id', 'label' => 'Member', 'type' => 'select', 'required' => true, 'options' => \App\Models\LibraryMember::class, 'optionLabel' => 'card_no', 'relation' => 'libraryMember.card_no'],
            ['name' => 'issue_date', 'label' => 'Issue Date', 'type' => 'date', 'required' => true],
            ['name' => 'due_date', 'label' => 'Due Date', 'type' => 'date', 'required' => true],
            ['name' => 'returned_at', 'label' => 'Return Date', 'type' => 'date'],
            ['name' => 'fine', 'label' => 'Fine', 'type' => 'number'],
            ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'options' => ['issued' => 'Issued', 'returned' => 'Returned'], 'default' => 'issued'],
    ];
}
