<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\FeesPayment;
use App\Models\Notice;
use App\Models\Staff;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return match ($user->role) {
            'admin', 'accountant' => $this->admin(),
            'teacher' => $this->teacher(),
            'student' => $this->student(),
            'parent'  => $this->parent(),
            default   => abort(403),
        };
    }

    protected function admin()
    {
        $today = today()->toDateString();

        $data = [
            'students'      => Student::where('status', 'active')->count(),
            'teachers'      => User::where('role', 'teacher')->count(),
            'staff'         => Staff::count(),
            'parents'       => User::where('role', 'parent')->count(),
            'presentToday'  => StudentAttendance::where('date', $today)->where('status', 'present')->count(),
            'absentToday'   => StudentAttendance::where('date', $today)->where('status', 'absent')->count(),
            'feesToday'     => FeesPayment::whereDate('payment_date', $today)->sum('amount'),
            'feesMonth'     => FeesPayment::whereMonth('payment_date', now()->month)->whereYear('payment_date', now()->year)->sum('amount'),
            'notices'       => Notice::latest('publish_date')->take(5)->get(),
            'events'        => Event::where('to_date', '>=', $today)->orderBy('from_date')->take(5)->get(),
        ];

        return view('dashboard.admin', $data);
    }

    protected function teacher()
    {
        $user = Auth::user();
        $data = [
            'routines' => \App\Models\ClassRoutine::with(['schoolClass', 'section', 'subject', 'classRoom'])
                ->where('teacher_id', $user->id)->orderBy('day')->orderBy('start_time')->get(),
            'studentsCount' => Student::where('status', 'active')->count(),
            'homeworks' => \App\Models\Homework::where('created_by', $user->id)->latest('homework_date')->take(5)->get(),
            'notices' => Notice::latest('publish_date')->take(5)->get(),
        ];
        return view('dashboard.teacher', $data);
    }

    protected function student()
    {
        $user = Auth::user();
        $student = $user->student;

        $data = [
            'student' => $student,
            'routines' => $student ? \App\Models\ClassRoutine::with(['subject', 'teacher', 'classRoom'])
                ->where('class_id', $student->class_id)->where('section_id', $student->section_id)
                ->orderBy('day')->orderBy('start_time')->get() : collect(),
            'attendanceSummary' => $student ? StudentAttendance::where('student_id', $student->id)
                ->selectRaw("status, count(*) as total")->groupBy('status')->pluck('total', 'status') : collect(),
            'materials' => $student ? \App\Models\UploadContent::where('class_id', $student->class_id)
                ->latest('upload_date')->take(5)->get() : collect(),
            'notices' => Notice::latest('publish_date')->take(5)->get(),
        ];
        return view('dashboard.student', $data);
    }

    protected function parent()
    {
        $user = Auth::user();
        $children = $user->children()->with(['schoolClass', 'section'])->get();

        return view('dashboard.parent', [
            'children' => $children,
            'notices'  => Notice::latest('publish_date')->take(5)->get(),
        ]);
    }
}
