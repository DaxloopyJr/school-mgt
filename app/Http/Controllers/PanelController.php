<?php

namespace App\Http\Controllers;

use App\Models\ClassRoutine;
use App\Models\Exam;
use App\Models\MarkRegister;
use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PanelController extends Controller
{
    public function profile()
    {
        return view('panel.profile', ['user' => auth()->user()]);
    }

    public function profileUpdate(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'password' => 'nullable|min:6|confirmed',
        ]);
        $user->name = $data['name'];
        $user->phone = $data['phone'] ?? $user->phone;
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();
        return back()->with('success', 'Profile updated.');
    }

    public function routine(Request $request)
    {
        $student = $this->resolveStudent($request);
        $routines = $student
            ? ClassRoutine::with(['subject', 'teacher', 'classRoom'])
                ->where('class_id', $student->class_id)->where('section_id', $student->section_id)
                ->orderBy('start_time')->get()->groupBy('day')
            : collect();
        return view('panel.routine', ['student' => $student, 'routines' => $routines, 'children' => $this->children()]);
    }

    public function marks(Request $request)
    {
        $student = $this->resolveStudent($request);
        $rows = $student
            ? MarkRegister::with(['exam', 'subject'])->where('student_id', $student->id)->get()->groupBy('exam_id')
            : collect();
        return view('panel.marks', ['student' => $student, 'rows' => $rows, 'children' => $this->children()]);
    }

    public function attendance(Request $request)
    {
        $student = $this->resolveStudent($request);
        $records = $student
            ? StudentAttendance::where('student_id', $student->id)->latest('date')->paginate(30)
            : collect();
        $summary = $student
            ? StudentAttendance::where('student_id', $student->id)->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status')
            : collect();
        return view('panel.attendance', ['student' => $student, 'records' => $records, 'summary' => $summary, 'children' => $this->children()]);
    }

    public function results(Request $request)
    {
        $student = $this->resolveStudent($request);
        $exams = $student
            ? Exam::where('class_id', $student->class_id)->orderByDesc('start_date')->get()
            : collect();
        $results = [];
        foreach ($exams as $exam) {
            $marks = MarkRegister::with('subject')->where('exam_id', $exam->id)->where('student_id', $student->id)->get();
            if ($marks->isNotEmpty()) {
                $results[] = ['exam' => $exam, 'marks' => $marks, 'total' => $marks->sum('marks')];
            }
        }
        return view('panel.results', ['student' => $student, 'results' => $results, 'children' => $this->children()]);
    }

    public function myStudents(Request $request)
    {
        $user = auth()->user();
        $classIds = ClassRoutine::where('teacher_id', $user->id)->pluck('class_id')->unique();
        $students = Student::with(['schoolClass', 'section'])
            ->whereIn('class_id', $classIds)->where('status', 'active')
            ->orderBy('class_id')->orderBy('roll_no')->paginate(30);
        return view('panel.students', ['students' => $students]);
    }

    protected function children()
    {
        return auth()->user()->role === 'parent' ? auth()->user()->children : collect();
    }

    protected function resolveStudent(Request $request): ?Student
    {
        $user = auth()->user();
        if ($user->role === 'student') {
            return $user->student;
        }
        if ($user->role === 'parent') {
            $childId = $request->get('student') ?: $user->children()->value('id');
            return $user->children()->where('id', $childId)->first() ?? $user->children()->first();
        }
        return null;
    }
}
