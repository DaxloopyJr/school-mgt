<?php

namespace App\Http\Controllers;

use App\Models\ItemIssue;

class ItemIssueController extends CrudController
{
    protected string $model = ItemIssue::class;
    protected string $route = 'item-issues';
    protected string $title = 'Item Issue';
    protected array $with = ['item'];

    protected array $fields = [
            ['name' => 'item_id', 'label' => 'Item', 'type' => 'select', 'required' => true, 'options' => \App\Models\Item::class, 'optionLabel' => 'name', 'relation' => 'item.name'],
            ['name' => 'issued_to', 'label' => 'Issued To', 'type' => 'text', 'required' => true],
            ['name' => 'quantity', 'label' => 'Quantity', 'type' => 'integer', 'required' => true],
            ['name' => 'issue_date', 'label' => 'Issue Date', 'type' => 'date', 'required' => true],
            ['name' => 'return_date', 'label' => 'Return Date', 'type' => 'date'],
            ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'options' => ['issued' => 'Issued', 'returned' => 'Returned'], 'default' => 'issued'],
    ];
}
