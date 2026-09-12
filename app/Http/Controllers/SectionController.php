<?php

namespace App\Http\Controllers;

use App\Models\Section;

class SectionController extends CrudController
{
    protected string $model = Section::class;
    protected string $route = 'sections';
    protected string $title = 'Section';
    protected array $with = ['schoolClass'];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Section Name', 'type' => 'text', 'required' => true, 'search' => true, 'hint' => 'Create multiple at once: separate names with commas, e.g. A,B,C'],
            ['name' => 'capacity', 'label' => 'Capacity', 'type' => 'integer'],
            ['name' => 'class_id', 'label' => 'Class', 'type' => 'select', 'required' => true, 'options' => \App\Models\SchoolClass::class, 'optionLabel' => 'name', 'relation' => 'schoolClass.name'],
    ];

    public function store(\Illuminate\Http\Request $request)
    {
        $request->merge(['name' => trim($request->name)]);
        $names = array_filter(array_map('trim', explode(',', $request->name)));
        if (count($names) > 1) {
            $request->validate(['name' => 'required|string', 'class_id' => 'required']);
            foreach ($names as $n) {
                \App\Models\Section::create(['name' => $n, 'class_id' => $request->class_id, 'capacity' => $request->capacity]);
            }
            return redirect()->route($this->route . '.index')->with('success', count($names) . ' sections created successfully.');
        }
        return parent::store($request);
    }
}
