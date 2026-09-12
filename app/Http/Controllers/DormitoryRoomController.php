<?php

namespace App\Http\Controllers;

use App\Models\DormitoryRoom;

class DormitoryRoomController extends CrudController
{
    protected string $model = DormitoryRoom::class;
    protected string $route = 'dormitory-rooms';
    protected string $title = 'Dormitory Room';
    protected array $with = ['dormitory', 'roomType'];

    protected array $fields = [
            ['name' => 'dormitory_id', 'label' => 'Dormitory', 'type' => 'select', 'required' => true, 'options' => \App\Models\Dormitory::class, 'optionLabel' => 'name', 'relation' => 'dormitory.name'],
            ['name' => 'room_type_id', 'label' => 'Room Type', 'type' => 'select', 'options' => \App\Models\RoomType::class, 'optionLabel' => 'name', 'relation' => 'roomType.name'],
            ['name' => 'name', 'label' => 'Room Name/No', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'no_of_beds', 'label' => 'No. of Beds', 'type' => 'integer', 'required' => true],
            ['name' => 'cost_per_bed', 'label' => 'Cost Per Bed', 'type' => 'number'],
    ];
}
