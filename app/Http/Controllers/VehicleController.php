<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;

class VehicleController extends CrudController
{
    protected string $model = Vehicle::class;
    protected string $route = 'vehicles';
    protected string $title = 'Vehicle';
    protected array $with = ['transportRoute'];

    protected array $fields = [
            ['name' => 'vehicle_no', 'label' => 'Vehicle No', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'model', 'label' => 'Model', 'type' => 'text'],
            ['name' => 'driver_name', 'label' => 'Driver Name', 'type' => 'text'],
            ['name' => 'driver_phone', 'label' => 'Driver Phone', 'type' => 'text'],
            ['name' => 'capacity', 'label' => 'Capacity', 'type' => 'integer'],
            ['name' => 'transport_route_id', 'label' => 'Route', 'type' => 'select', 'options' => \App\Models\TransportRoute::class, 'optionLabel' => 'title', 'relation' => 'transportRoute.title'],
    ];
}
