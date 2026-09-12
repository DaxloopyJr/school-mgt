<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends CrudController
{
    protected string $model = User::class;
    protected string $route = 'users';
    protected string $title = 'User';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true, 'search' => true],
            ['name' => 'role', 'label' => 'Role', 'type' => 'select', 'required' => true, 'options' => ['admin' => 'Admin', 'accountant' => 'Accountant', 'teacher' => 'Teacher', 'student' => 'Student', 'parent' => 'Parent']],
            ['name' => 'phone', 'label' => 'Phone', 'type' => 'text'],
            ['name' => 'password', 'label' => 'Password', 'type' => 'password', 'list' => false],
            ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'options' => ['active' => 'Active', 'inactive' => 'Inactive'], 'default' => 'active'],
    ];

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate(['password' => 'required|min:6']);
        return parent::store($request);
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        if (!$request->filled('password')) {
            $request->request->remove('password');
        }
        return parent::update($request, $id);
    }
}
