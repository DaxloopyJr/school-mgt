<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

abstract class CrudController extends Controller
{
    protected string $model;
    protected array $fields = [];
    protected string $route = '';
    protected string $title = '';
    protected array $with = [];
    protected int $perPage = 15;

    protected function query()
    {
        return ($this->model)::with($this->with)->latest();
    }

    public function index(Request $request)
    {
        $q = $this->query();

        if ($search = $request->get('q')) {
            $searchable = collect($this->fields)
                ->filter(fn ($f) => ($f['search'] ?? false) && in_array($f['type'] ?? 'text', ['text', 'email', 'textarea']))
                ->pluck('name');
            if ($searchable->isNotEmpty()) {
                $q->where(function ($sub) use ($searchable, $search) {
                    foreach ($searchable as $col) {
                        $sub->orWhere($col, 'like', "%{$search}%");
                    }
                });
            }
        }

        $items = $q->paginate($this->perPage)->withQueryString();

        return view('crud.index', [
            'items'  => $items,
            'fields' => $this->fields,
            'title'  => $this->title,
            'route'  => $this->route,
        ]);
    }

    public function create()
    {
        return view('crud.form', [
            'item'   => null,
            'fields' => $this->resolveOptions(),
            'title'  => $this->title,
            'route'  => $this->route,
        ]);
    }

    public function store(Request $request)
    {
        ($this->model)::create($this->validatedData($request));

        return redirect()->route($this->route . '.index')
            ->with('success', $this->title . ' created successfully.');
    }

    public function edit($id)
    {
        $item = ($this->model)::findOrFail($id);

        return view('crud.form', [
            'item'   => $item,
            'fields' => $this->resolveOptions(),
            'title'  => $this->title,
            'route'  => $this->route,
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = ($this->model)::findOrFail($id);
        $item->update($this->validatedData($request, $item));

        return redirect()->route($this->route . '.index')
            ->with('success', $this->title . ' updated successfully.');
    }

    public function destroy($id)
    {
        $item = ($this->model)::findOrFail($id);
        if (!empty($item->file) && Storage::disk('public')->exists($item->file)) {
            Storage::disk('public')->delete($item->file);
        }
        $item->delete();

        return redirect()->route($this->route . '.index')
            ->with('success', $this->title . ' deleted successfully.');
    }

    protected function rules($item = null): array
    {
        $rules = [];
        foreach ($this->fields as $f) {
            $r = [!empty($f['required']) ? 'required' : 'nullable'];
            switch ($f['type'] ?? 'text') {
                case 'number':
                case 'integer': $r[] = 'numeric'; break;
                case 'date':    $r[] = 'date'; break;
                case 'time':    $r[] = 'date_format:H:i'; break;
                case 'email':   $r[] = 'email'; break;
                case 'file':    $r[] = 'file'; $r[] = 'mimes:jpg,jpeg,png,pdf,doc,docx,mp4,mp3'; $r[] = 'max:20480'; break;
                case 'checkbox':$r[] = 'boolean'; break;
                case 'password':$r[] = 'string'; $r[] = 'min:6'; break;
                default:        $r[] = 'string'; $r[] = 'max:2000';
            }
            $rules[$f['name']] = implode('|', $r);
        }
        return $rules;
    }

    protected function validatedData(Request $request, $item = null): array
    {
        $data = $request->validate($this->rules($item));

        foreach ($this->fields as $f) {
            $type = $f['type'] ?? 'text';
            if ($type === 'checkbox') {
                $data[$f['name']] = $request->boolean($f['name']);
            }
            if ($type === 'file') {
                if ($request->hasFile($f['name'])) {
                    $data[$f['name']] = $request->file($f['name'])
                        ->store('uploads/' . Str::snake($this->route), 'public');
                } else {
                    unset($data[$f['name']]);
                }
            }
        }
        return $data;
    }

    protected function resolveOptions(): array
    {
        $fields = [];
        foreach ($this->fields as $f) {
            if (($f['type'] ?? '') === 'select' && isset($f['options'])) {
                if (is_callable($f['options'])) {
                    $f['options'] = call_user_func($f['options']);
                } elseif (is_string($f['options']) && str_starts_with($f['options'], '@')) {
                    $f['options'] = match ($f['options']) {
                        '@teachers'      => \App\Models\User::where('role', 'teacher')->orderBy('name')->pluck('name', 'id')->toArray(),
                        '@parents'       => \App\Models\User::where('role', 'parent')->orderBy('name')->pluck('name', 'id')->toArray(),
                        '@student_users' => \App\Models\User::where('role', 'student')->orderBy('name')->pluck('name', 'id')->toArray(),
                        '@students'      => \App\Models\Student::orderBy('first_name')->get()->mapWithKeys(fn ($s) => [$s->id => $s->fullName() . ' (' . $s->admission_no . ')'])->toArray(),
                        '@staffs'        => \App\Models\Staff::orderBy('name')->pluck('name', 'id')->toArray(),
                        default          => [],
                    };
                } elseif (is_string($f['options'])) {
                    $model = $f['options'];
                    $label = $f['optionLabel'] ?? 'name';
                    $f['options'] = $model::orderBy($label)->pluck($label, 'id')->toArray();
                }
            }
            $fields[] = $f;
        }
        return $fields;
    }
}
