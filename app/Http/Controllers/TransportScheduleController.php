<?php

namespace App\Http\Controllers;

use App\Models\TransportSchedule;

class TransportScheduleController extends CrudController
{
    protected string $model = TransportSchedule::class;
    protected string $route = 'transport-schedules';
    protected string $title = 'Transport Schedule';
    protected array $with = ['transportRoute', 'vehicle'];

    protected array $fields = [
            ['name' => 'transport_route_id', 'label' => 'Route', 'type' => 'select', 'required' => true, 'options' => \App\Models\TransportRoute::class, 'optionLabel' => 'title', 'relation' => 'transportRoute.title'],
            ['name' => 'vehicle_id', 'label' => 'Vehicle', 'type' => 'select', 'options' => \App\Models\Vehicle::class, 'optionLabel' => 'vehicle_no', 'relation' => 'vehicle.vehicle_no'],
            ['name' => 'day', 'label' => 'Day', 'type' => 'select', 'options' => ['Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday', 'Sunday' => 'Sunday']],
            ['name' => 'departure_time', 'label' => 'Departure Time', 'type' => 'time'],
    ];
}
