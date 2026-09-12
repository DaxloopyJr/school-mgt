<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;

class ContactMessageController extends CrudController
{
    protected string $model = ContactMessage::class;
    protected string $route = 'contact-messages';
    protected string $title = 'Contact Message';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'email', 'label' => 'Email', 'type' => 'email'],
            ['name' => 'phone', 'label' => 'Phone', 'type' => 'text'],
            ['name' => 'subject', 'label' => 'Subject', 'type' => 'text'],
            ['name' => 'message', 'label' => 'Message', 'type' => 'textarea', 'list' => false],
    ];
}
