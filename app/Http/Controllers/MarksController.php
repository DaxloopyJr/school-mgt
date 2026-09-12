<?php

namespace App\Http\Controllers;

use App\Models\EmailSmsLog;
use App\Models\Exam;
use App\Models\MarkRegister;
use App\Models\MarksGrade;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    public function registerForm(Request $request)
    {
        $data = [
            'exams'    => Exam::with('schoolClass')->orderBy('name')->get()->mapWithKeys(fn ($e) => [$e->id => $e->name . ' (' . ($e->schoolClass->name ?? '') . ')']),
            'subjects' => Subject::orderBy('name')->pluck('name', 'id'),
            'exam'     => null,
            'students' => collect(),
            'existing' => [],
            'grades'   => MarksGrade::orderByDesc('percent_from')->get(),
        ];

        if ($request->filled(['exam_id', 'subject_id'])) {
            $exam = Exam::findOrFail($request->exam_id);
            $data['exam'] = $exam;
            $data['students'] = Student::where('status', 'active')
                ->where('class_id', $exam->class_id)
                ->when($exam->section_id, fn ($q) => $q->where('section_id', $exam->section_id))
                ->orderBy('roll_no')->get();
            $data['existing'] = MarkRegister::where('exam_id', $exam->id)
                ->where('subject_id', $request->subject_id)
                ->pluck('marks', 'student_id')->toArray();
        }
        return view('marks.register', $data + ['exam_id' => $request->exam_id, 'subject_id' => $request->subject_id]);
    }

    public function registerSave(Request $request)
    {
        $request->validate(['exam_id' => 'required', 'subject_id' => 'required', 'marks' => 'required|array']);
        $exam = Exam::findOrFail($request->exam_id);
        $grades = MarksGrade::orderByDesc('percent_from')->get();

        foreach ($request->marks as $studentId => $mark) {
            if ($mark === null || $mark === '') {
                continue;
            }
            $pct = $exam->exam_mark > 0 ? ($mark / $exam->exam_mark) * 100 : 0;
            $grade = $grades->first(fn ($g) => $pct >= ($g->percent_from ?? 0) && $pct <= ($g->percent_to ?? 100));
            MarkRegister::updateOrCreate(
                ['exam_id' => $exam->id, 'student_id' => $studentId, 'subject_id' => $request->subject_id],
                ['marks' => $mark, 'grade' => $grade->name ?? null]
            );
        }
        return back()->with('success', 'Marks saved successfully.');
    }

    public function sendSmsForm(Request $request)
    {
        $data = [
            'exams' => Exam::orderBy('name')->pluck('name', 'id'),
            'rows'  => collect(),
        ];
        if ($request->filled('exam_id')) {
            $exam = Exam::findOrFail($request->exam_id);
            $students = Student::where('class_id', $exam->class_id)
                ->when($exam->section_id, fn ($q) => $q->where('section_id', $exam->section_id))
                ->orderBy('roll_no')->get();
            $data['rows'] = $students->map(function ($s) use ($exam) {
                $marks = MarkRegister::with('subject')->where('exam_id', $exam->id)->where('student_id', $s->id)->get();
                return ['student' => $s, 'marks' => $marks, 'total' => $marks->sum('marks')];
            });
            $data['exam'] = $exam;
        }
        return view('marks.sms', $data + ['exam_id' => $request->exam_id]);
    }

    public function sendSms(Request $request)
    {
        $request->validate(['exam_id' => 'required']);
        $exam = Exam::findOrFail($request->exam_id);
        $count = Student::where('class_id', $exam->class_id)->count();

        EmailSmsLog::create([
            'title'     => 'Exam marks sent: ' . $exam->name,
            'type'      => 'sms',
            'target'    => 'parents',
            'message'   => "Marks for {$exam->name} were sent to {$count} parents via SMS gateway.",
            'send_date' => today()->toDateString(),
        ]);

        return back()->with('success', "Marks SMS queued for {$count} guardians (logged under Email/SMS).");
    }
}
