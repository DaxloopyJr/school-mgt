<?php

namespace App\Http\Controllers;

use App\Models\PhoneCallLog;

class PhoneCallLogController extends CrudController
{
    protected string $model = PhoneCallLog::class;
    protected string $route = 'phone-call-logs';
    protected string $title = 'Phone Call Log';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'phone', 'label' => 'Phone', 'type' => 'text', 'search' => true],
            ['name' => 'date', 'label' => 'Date', 'type' => 'date', 'required' => true],
            ['name' => 'call_duration', 'label' => 'Call Duration', 'type' => 'text'],
            ['name' => 'call_type', 'label' => 'Call Type', 'type' => 'select', 'options' => ['incoming' => 'Incoming', 'outgoing' => 'Outgoing']],
            ['name' => 'next_follow_up_date', 'label' => 'Next Follow Up', 'type' => 'date'],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
