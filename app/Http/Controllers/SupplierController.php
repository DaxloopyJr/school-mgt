<?php

namespace App\Http\Controllers;

use App\Models\Supplier;

class SupplierController extends CrudController
{
    protected string $model = Supplier::class;
    protected string $route = 'suppliers';
    protected string $title = 'Supplier';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Supplier Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'contact_person', 'label' => 'Contact Person', 'type' => 'text'],
            ['name' => 'phone', 'label' => 'Phone', 'type' => 'text'],
            ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'list' => false],
            ['name' => 'address', 'label' => 'Address', 'type' => 'textarea', 'list' => false],
    ];
}
