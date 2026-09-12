<?php

namespace App\Http\Controllers;

use App\Models\Notice;

class NoticeController extends CrudController
{
    protected string $model = Notice::class;
    protected string $route = 'notices';
    protected string $title = 'Notice';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'title', 'label' => 'Title', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'message', 'label' => 'Message', 'type' => 'textarea', 'required' => true, 'list' => false],
            ['name' => 'publish_date', 'label' => 'Publish Date', 'type' => 'date', 'required' => true],
            ['name' => 'target', 'label' => 'Visible To', 'type' => 'select', 'options' => ['all' => 'Everyone', 'students' => 'Students', 'parents' => 'Parents', 'teachers' => 'Teachers', 'staff' => 'Staff'], 'default' => 'all'],
    ];
}
