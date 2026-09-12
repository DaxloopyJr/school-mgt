<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;

class TestimonialController extends CrudController
{
    protected string $model = Testimonial::class;
    protected string $route = 'testimonials';
    protected string $title = 'Testimonial';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'designation', 'label' => 'Designation', 'type' => 'text'],
            ['name' => 'image', 'label' => 'Photo', 'type' => 'file'],
            ['name' => 'description', 'label' => 'Testimonial', 'type' => 'textarea', 'list' => false],
    ];
}
