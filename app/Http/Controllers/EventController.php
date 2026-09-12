<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends CrudController
{
    protected string $model = Event::class;
    protected string $route = 'events';
    protected string $title = 'Event';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'title', 'label' => 'Event Title', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
            ['name' => 'from_date', 'label' => 'From Date', 'type' => 'date', 'required' => true],
            ['name' => 'to_date', 'label' => 'To Date', 'type' => 'date', 'required' => true],
            ['name' => 'location', 'label' => 'Location', 'type' => 'text'],
    ];
}
