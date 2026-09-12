<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;

class SocialLinkController extends CrudController
{
    protected string $model = SocialLink::class;
    protected string $route = 'social-links';
    protected string $title = 'Social Link';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Name (e.g. Facebook)', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'url', 'label' => 'URL', 'type' => 'text', 'required' => true],
            ['name' => 'icon', 'label' => 'Icon class (e.g. bi-facebook)', 'type' => 'text'],
    ];
}
