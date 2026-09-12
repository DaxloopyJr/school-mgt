<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;

class ClassRoomController extends CrudController
{
    protected string $model = ClassRoom::class;
    protected string $route = 'class-rooms';
    protected string $title = 'Class Room';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Room Name/No', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'capacity', 'label' => 'Capacity', 'type' => 'integer'],
    ];
}
