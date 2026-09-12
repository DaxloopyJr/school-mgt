<?php

namespace App\Http\Controllers;

use App\Models\EmailSmsLog;

class EmailSmsLogController extends CrudController
{
    protected string $model = EmailSmsLog::class;
    protected string $route = 'email-sms';
    protected string $title = 'Email / SMS';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'title', 'label' => 'Title', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'type', 'label' => 'Type', 'type' => 'select', 'required' => true, 'options' => ['email' => 'Email', 'sms' => 'SMS']],
            ['name' => 'target', 'label' => 'Send To', 'type' => 'select', 'options' => ['all' => 'Everyone', 'students' => 'Students', 'parents' => 'Parents', 'teachers' => 'Teachers', 'staff' => 'Staff'], 'default' => 'all'],
            ['name' => 'message', 'label' => 'Message', 'type' => 'textarea', 'required' => true, 'list' => false],
            ['name' => 'send_date', 'label' => 'Send Date', 'type' => 'date'],
    ];
}
