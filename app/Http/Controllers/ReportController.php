<?php

namespace App\Http\Controllers;

use App\Models\ClassRoutine;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\MarkRegister;
use App\Models\OnlineExam;
use App\Models\OnlineExamAttempt;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use App\Models\UserLogin;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected function filters(): array
    {
        return [
            'classes'  => SchoolClass::orderBy('name')->pluck('name', 'id'),
            'sections' => Section::orderBy('name')->pluck('name', 'id'),
            'exams'    => Exam::orderBy('name')->pluck('name', 'id'),
            'teachers' => User::where('role', 'teacher')->orderBy('name')->pluck('name', 'id'),
        ];
    }

    public function student(Request $request)
    {
        $q = Student::with(['schoolClass', 'section', 'category'])->orderBy('class_id')->orderBy('roll_no');
        if ($request->class_id)   $q->where('class_id', $request->class_id);
        if ($request->section_id) $q->where('section_id', $request->section_id);
        if ($request->status)     $q->where('status', $request->status);
        return view('reports.table', $this->filters() + [
            'title'   => 'Student Report',
            'filter'  => 'class',
            'columns' => ['Admission No', 'Roll', 'Name', 'Gender', 'Class', 'Section', 'Category', 'Phone', 'Status'],
            'rows'    => $q->get()->map(fn ($s) => [$s->admission_no, $s->roll_no, $s->fullName(), $s->gender, $s->schoolClass->name ?? '-', $s->section->name ?? '-', $s->category->name ?? '-', $s->phone, $s->status]),
        ]);
    }

    public function guardian(Request $request)
    {
        $q = Student::with(['schoolClass', 'parent'])->whereNotNull('parent_id');
        if ($request->class_id) $q->where('class_id', $request->class_id);
        return view('reports.table', $this->filters() + [
            'title'   => 'Guardian Report',
            'filter'  => 'class',
            'columns' => ['Student', 'Class', 'Roll', 'Guardian', 'Guardian Email', 'Guardian Phone'],
            'rows'    => $q->get()->map(fn ($s) => [$s->fullName(), $s->schoolClass->name ?? '-', $s->roll_no, $s->parent->name ?? '-', $s->parent->email ?? '-', $s->parent->phone ?? '-']),
        ]);
    }

    public function studentHistory()
    {
        $rows = Student::with('schoolClass')->orderByDesc('admission_date')->get()
            ->map(fn ($s) => [$s->admission_no, $s->fullName(), $s->schoolClass->name ?? '-', $s->admission_date?->toDateString(), $s->status]);
        return view('reports.table', $this->filters() + [
            'title' => 'Student History', 'filter' => 'none',
            'columns' => ['Admission No', 'Name', 'Class', 'Admission Date', 'Status'], 'rows' => $rows,
        ]);
    }

    public function login()
    {
        $rows = UserLogin::with('user')->latest('logged_in_at')->take(200)->get()
            ->map(fn ($l) => [$l->user->name ?? '-', $l->user->role ?? '-', $l->ip, $l->logged_in_at]);
        return view('reports.table', $this->filters() + [
            'title' => 'Student / User Login Report', 'filter' => 'none',
            'columns' => ['User', 'Role', 'IP', 'Logged In At'], 'rows' => $rows,
        ]);
    }

    public function userLog()
    {
        return $this->login();
    }

    public function feesStatement(Request $request)
    {
        $student = null;
        $payments = collect();
        if ($request->filled('search')) {
            $student = Student::where('admission_no', $request->search)
                ->orWhere('first_name', 'like', '%' . $request->search . '%')->first();
            if ($student) {
                $payments = $student->feesPayments()->with('feesMaster.feesType')->latest('payment_date')->get();
            }
        }
        return view('reports.fees-statement', ['student' => $student, 'payments' => $payments, 'search' => $request->search]);
    }

    public function balanceFees(Request $request)
    {
        $rows = collect();
        if ($request->filled('class_id')) {
            $rows = Student::with(['schoolClass', 'section'])->where('class_id', $request->class_id)->where('status', 'active')
                ->orderBy('roll_no')->get()
                ->map(fn ($s) => [$s->roll_no, $s->fullName(), $s->schoolClass->name ?? '-', number_format($s->totalPayable(), 2), number_format($s->totalPaid(), 2), number_format($s->balance(), 2)]);
        }
        return view('reports.table', $this->filters() + [
            'title' => 'Balance Fees Report', 'filter' => 'class',
            'columns' => ['Roll', 'Student', 'Class', 'Total Payable', 'Paid', 'Balance'], 'rows' => $rows,
        ]);
    }

    public function classReport(Request $request)
    {
        $rows = SchoolClass::withCount(['students' => fn ($q) => $q->where('status', 'active')])
            ->with(['sections'])->orderBy('name')->get()
            ->map(fn ($c) => [$c->name, $c->sections->count(), $c->students_count]);
        return view('reports.table', $this->filters() + [
            'title' => 'Class Report', 'filter' => 'none',
            'columns' => ['Class', 'Sections', 'Active Students'], 'rows' => $rows,
        ]);
    }

    public function classRoutine(Request $request)
    {
        $rows = collect();
        if ($request->filled('class_id')) {
            $rows = ClassRoutine::with(['schoolClass', 'section', 'subject', 'teacher', 'classRoom'])
                ->where('class_id', $request->class_id)
                ->when($request->section_id, fn ($q) => $q->where('section_id', $request->section_id))
                ->orderBy('day')->orderBy('start_time')->get()
                ->map(fn ($r) => [$r->day, $r->schoolClass->name ?? '-', $r->section->name ?? '-', $r->subject->name ?? '-', $r->teacher->name ?? '-', $r->start_time . ' - ' . $r->end_time, $r->classRoom->name ?? '-']);
        }
        return view('reports.table', $this->filters() + [
            'title' => 'Class Routine Report', 'filter' => 'class',
            'columns' => ['Day', 'Class', 'Section', 'Subject', 'Teacher', 'Time', 'Room'], 'rows' => $rows,
        ]);
    }

    public function examRoutine(Request $request)
    {
        $rows = collect();
        if ($request->filled('exam_id')) {
            $rows = ExamSchedule::with(['exam', 'subject'])->where('exam_id', $request->exam_id)
                ->orderBy('date')->orderBy('start_time')->get()
                ->map(fn ($s) => [$s->exam->name ?? '-', $s->subject->name ?? '-', $s->date?->toDateString(), $s->start_time . ' - ' . $s->end_time, $s->room]);
        }
        return view('reports.table', $this->filters() + [
            'title' => 'Exam Routine Report', 'filter' => 'exam',
            'columns' => ['Exam', 'Subject', 'Date', 'Time', 'Room'], 'rows' => $rows,
        ]);
    }

    public function teacherRoutine(Request $request)
    {
        $rows = collect();
        if ($request->filled('teacher_id')) {
            $rows = ClassRoutine::with(['schoolClass', 'section', 'subject', 'classRoom'])
                ->where('teacher_id', $request->teacher_id)->orderBy('day')->orderBy('start_time')->get()
                ->map(fn ($r) => [$r->day, $r->schoolClass->name ?? '-', $r->section->name ?? '-', $r->subject->name ?? '-', $r->start_time . ' - ' . $r->end_time, $r->classRoom->name ?? '-']);
        }
        return view('reports.table', $this->filters() + [
            'title' => 'Teacher Class Routine', 'filter' => 'teacher',
            'columns' => ['Day', 'Class', 'Section', 'Subject', 'Time', 'Room'], 'rows' => $rows,
        ]);
    }

    public function meritList(Request $request)
    {
        $rows = collect();
        if ($request->filled('exam_id')) {
            $exam = Exam::find($request->exam_id);
            $marks = MarkRegister::with('student')->where('exam_id', $request->exam_id)->get()->groupBy('student_id');
            $rows = $marks->map(fn ($m, $sid) => ['student' => $m->first()->student, 'total' => $m->sum('marks'), 'subjects' => $m->count()])
                ->sortByDesc('total')->values()
                ->map(fn ($r, $i) => [$i + 1, $r['student']->roll_no ?? '-', $r['student']->fullName() ?? '-', $r['subjects'], number_format($r['total'], 2)]);
        }
        return view('reports.table', $this->filters() + [
            'title' => 'Merit List Report', 'filter' => 'exam',
            'columns' => ['Position', 'Roll', 'Student', 'Subjects', 'Total Marks'], 'rows' => $rows,
        ]);
    }

    public function onlineExam(Request $request)
    {
        $exams = OnlineExam::orderBy('title')->pluck('title', 'id');
        $rows = collect();
        if ($request->filled('online_exam_id')) {
            $rows = OnlineExamAttempt::with('student')->where('online_exam_id', $request->online_exam_id)
                ->orderByDesc('score')->get()
                ->map(fn ($a) => [$a->student->roll_no ?? '-', $a->student->fullName() ?? '-', $a->score, $a->submitted_at]);
        }
        return view('reports.table', $this->filters() + [
            'title' => 'Online Exam Report', 'filter' => 'online_exam', 'online_exams' => $exams,
            'columns' => ['Roll', 'Student', 'Score', 'Submitted At'], 'rows' => $rows,
        ]);
    }

    public function markSheet(Request $request)
    {
        $student = null;
        $exam = null;
        $marks = collect();
        if ($request->filled(['exam_id', 'search'])) {
            $exam = Exam::find($request->exam_id);
            $student = Student::where('admission_no', $request->search)->orWhere('first_name', 'like', '%' . $request->search . '%')->first();
            if ($student && $exam) {
                $marks = MarkRegister::with('subject')->where('exam_id', $exam->id)->where('student_id', $student->id)->get();
            }
        }
        return view('reports.mark-sheet', $this->filters() + ['student' => $student, 'exam' => $exam, 'marks' => $marks, 'search' => $request->search]);
    }

    public function tabulation(Request $request)
    {
        $exam = null;
        $students = collect();
        $subjects = collect();
        $marks = [];
        if ($request->filled('exam_id')) {
            $exam = Exam::findOrFail($request->exam_id);
            $all = MarkRegister::with(['student', 'subject'])->where('exam_id', $exam->id)->get();
            $subjects = $all->pluck('subject')->filter()->unique('id')->values();
            $students = $all->pluck('student')->filter()->unique('id')->sortBy('roll_no')->values();
            foreach ($all as $m) {
                $marks[$m->student_id][$m->subject_id] = $m->marks;
            }
        }
        return view('reports.tabulation', $this->filters() + ['exam' => $exam, 'students' => $students, 'subjects' => $subjects, 'marks' => $marks]);
    }

    public function progressCard(Request $request)
    {
        $student = null;
        $exams = collect();
        if ($request->filled('search')) {
            $student = Student::where('admission_no', $request->search)->orWhere('first_name', 'like', '%' . $request->search . '%')->first();
            if ($student) {
                $exams = Exam::where('class_id', $student->class_id)->get()->map(function ($e) use ($student) {
                    $marks = MarkRegister::with('subject')->where('exam_id', $e->id)->where('student_id', $student->id)->get();
                    return ['exam' => $e, 'marks' => $marks, 'total' => $marks->sum('marks')];
                })->filter(fn ($r) => $r['marks']->isNotEmpty());
            }
        }
        return view('reports.progress-card', ['student' => $student, 'exams' => $exams, 'search' => $request->search]);
    }

    public function previousResult(Request $request)
    {
        return $this->meritList($request)->with('titleOverride', 'Previous Result');
    }
}
