<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\HomeworkEvaluation;
use App\Models\Student;
use Illuminate\Http\Request;

class HomeworkReportController extends Controller
{
    public function evaluation(Request $request)
    {
        $homeworks = Homework::with('schoolClass')->orderByDesc('homework_date')->get()
            ->mapWithKeys(fn ($h) => [$h->id => \Illuminate\Support\Str::limit($h->description, 40) . ' (' . ($h->schoolClass->name ?? '') . ')']);

        $homework = null;
        $rows = collect();
        if ($request->filled('homework_id')) {
            $homework = Homework::with(['schoolClass', 'section', 'subject'])->findOrFail($request->homework_id);
            $students = Student::where('class_id', $homework->class_id)
                ->when($homework->section_id, fn ($q) => $q->where('section_id', $homework->section_id))
                ->where('status', 'active')->orderBy('roll_no')->get();
            $evals = HomeworkEvaluation::where('homework_id', $homework->id)->get()->keyBy('student_id');
            $rows = $students->map(fn ($s) => ['student' => $s, 'eval' => $evals->get($s->id)]);
        }

        return view('homework.evaluation', ['homeworks' => $homeworks, 'homework' => $homework, 'rows' => $rows]);
    }
}
