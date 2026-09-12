<?php

namespace App\Http\Controllers;

use App\Models\Topic;

class TopicController extends CrudController
{
    protected string $model = Topic::class;
    protected string $route = 'topics';
    protected string $title = 'Topic';
    protected array $with = ['lesson'];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Topic Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'lesson_id', 'label' => 'Lesson', 'type' => 'select', 'required' => true, 'options' => \App\Models\Lesson::class, 'optionLabel' => 'name', 'relation' => 'lesson.name'],
    ];
}
