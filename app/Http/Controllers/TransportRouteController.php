<?php

namespace App\Http\Controllers;

use App\Models\TransportRoute;

class TransportRouteController extends CrudController
{
    protected string $model = TransportRoute::class;
    protected string $route = 'transport-routes';
    protected string $title = 'Transport Route';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'title', 'label' => 'Route Title', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'fare', 'label' => 'Fare', 'type' => 'number'],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
