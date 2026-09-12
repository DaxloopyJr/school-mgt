<?php

namespace App\Http\Controllers;

use App\Models\PostalDispatch;

class PostalDispatchController extends CrudController
{
    protected string $model = PostalDispatch::class;
    protected string $route = 'postal-dispatches';
    protected string $title = 'Postal Dispatch';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'to_title', 'label' => 'To Title', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'from_title', 'label' => 'From Title', 'type' => 'text'],
            ['name' => 'reference_no', 'label' => 'Reference No', 'type' => 'text'],
            ['name' => 'date', 'label' => 'Date', 'type' => 'date'],
            ['name' => 'address', 'label' => 'Address', 'type' => 'text', 'list' => false],
            ['name' => 'file', 'label' => 'Attachment', 'type' => 'file'],
            ['name' => 'note', 'label' => 'Note', 'type' => 'textarea', 'list' => false],
    ];
}
