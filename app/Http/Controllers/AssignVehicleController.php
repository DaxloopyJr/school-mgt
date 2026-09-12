<?php

namespace App\Http\Controllers;

use App\Models\AssignVehicle;

class AssignVehicleController extends CrudController
{
    protected string $model = AssignVehicle::class;
    protected string $route = 'assign-vehicles';
    protected string $title = 'Assign Vehicle';
    protected array $with = ['vehicle', 'transportRoute'];

    protected array $fields = [
            ['name' => 'vehicle_id', 'label' => 'Vehicle', 'type' => 'select', 'required' => true, 'options' => \App\Models\Vehicle::class, 'optionLabel' => 'vehicle_no', 'relation' => 'vehicle.vehicle_no'],
            ['name' => 'transport_route_id', 'label' => 'Route', 'type' => 'select', 'required' => true, 'options' => \App\Models\TransportRoute::class, 'optionLabel' => 'title', 'relation' => 'transportRoute.title'],
            ['name' => 'note', 'label' => 'Note', 'type' => 'textarea', 'list' => false],
    ];
}
