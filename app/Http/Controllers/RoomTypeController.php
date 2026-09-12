<?php

namespace App\Http\Controllers;

use App\Models\RoomType;

class RoomTypeController extends CrudController
{
    protected string $model = RoomType::class;
    protected string $route = 'room-types';
    protected string $title = 'Room Type';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Type Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
