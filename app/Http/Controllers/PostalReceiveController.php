<?php

namespace App\Http\Controllers;

use App\Models\PostalReceive;

class PostalReceiveController extends CrudController
{
    protected string $model = PostalReceive::class;
    protected string $route = 'postal-receives';
    protected string $title = 'Postal Receive';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'from_title', 'label' => 'From Title', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'to_title', 'label' => 'To Title', 'type' => 'text'],
            ['name' => 'reference_no', 'label' => 'Reference No', 'type' => 'text'],
            ['name' => 'date', 'label' => 'Date', 'type' => 'date'],
            ['name' => 'address', 'label' => 'Address', 'type' => 'text', 'list' => false],
            ['name' => 'file', 'label' => 'Attachment', 'type' => 'file'],
            ['name' => 'note', 'label' => 'Note', 'type' => 'textarea', 'list' => false],
    ];
}
