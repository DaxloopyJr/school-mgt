<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Staff;
use App\Models\StaffAttendance;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\Subject;
use App\Models\SubjectAttendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function studentForm(Request $request)
    {
        $data = $this->filters($request);
        $data['mode'] = 'student';
        $data['subjects'] = collect();
        $data['students'] = collect();
        $data['existing'] = [];

        if ($request->filled(['class_id', 'date'])) {
            $data['students'] = $this->students($request);
            $data['existing'] = StudentAttendance::where('date', $request->date)
                ->whereIn('student_id', $data['students']->pluck('id'))
                ->pluck('status', 'student_id')->toArray();
        }
        return view('attendance.take', $data);
    }

    public function studentSave(Request $request)
    {
        $request->validate(['class_id' => 'required', 'date' => 'required|date', 'status' => 'required|array']);
        foreach ($request->status as $studentId => $status) {
            StudentAttendance::updateOrCreate(
                ['student_id' => $studentId, 'date' => $request->date],
                ['class_id' => $request->class_id, 'section_id' => $request->section_id, 'status' => $status]
            );
        }
        return back()->with('success', 'Student attendance saved for ' . $request->date);
    }

    public function studentReport(Request $request)
    {
        $data = $this->filters($request);
        $data['rows'] = collect();
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);
        $data['month'] = $month;
        $data['year'] = $year;

        if ($request->filled('class_id')) {
            $students = $this->students($request);
            $data['rows'] = $students->map(function ($s) use ($month, $year) {
                $att = StudentAttendance::where('student_id', $s->id)
                    ->whereMonth('date', $month)->whereYear('date', $year)
                    ->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');
                return ['student' => $s, 'att' => $att];
            });
        }
        return view('attendance.report', $data + ['mode' => 'student', 'title' => 'Student Attendance Report']);
    }

    public function subjectForm(Request $request)
    {
        $data = $this->filters($request);
        $data['mode'] = 'subject';
        $data['subjects'] = Subject::orderBy('name')->pluck('name', 'id');
        $data['students'] = collect();
        $data['existing'] = [];

        if ($request->filled(['class_id', 'subject_id', 'date'])) {
            $data['students'] = $this->students($request);
            $data['existing'] = SubjectAttendance::where('date', $request->date)
                ->where('subject_id', $request->subject_id)
                ->whereIn('student_id', $data['students']->pluck('id'))
                ->pluck('status', 'student_id')->toArray();
        }
        return view('attendance.take', $data);
    }

    public function subjectSave(Request $request)
    {
        $request->validate(['class_id' => 'required', 'subject_id' => 'required', 'date' => 'required|date', 'status' => 'required|array']);
        foreach ($request->status as $studentId => $status) {
            SubjectAttendance::updateOrCreate(
                ['student_id' => $studentId, 'subject_id' => $request->subject_id, 'date' => $request->date],
                ['class_id' => $request->class_id, 'section_id' => $request->section_id, 'status' => $status]
            );
        }
        return back()->with('success', 'Subject wise attendance saved.');
    }

    public function subjectReport(Request $request)
    {
        $data = $this->filters($request);
        $data['subjects'] = Subject::orderBy('name')->pluck('name', 'id');
        $data['rows'] = collect();
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);
        $data['month'] = $month;
        $data['year'] = $year;

        if ($request->filled(['class_id', 'subject_id'])) {
            $students = $this->students($request);
            $data['rows'] = $students->map(function ($s) use ($request, $month, $year) {
                $att = SubjectAttendance::where('student_id', $s->id)->where('subject_id', $request->subject_id)
                    ->whereMonth('date', $month)->whereYear('date', $year)
                    ->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');
                return ['student' => $s, 'att' => $att];
            });
        }
        return view('attendance.report', $data + ['mode' => 'subject', 'title' => 'Subject Wise Attendance Report']);
    }

    public function staffForm(Request $request)
    {
        $date = $request->get('date', today()->toDateString());
        return view('attendance.staff', [
            'staffs'   => Staff::orderBy('name')->get(),
            'date'     => $date,
            'existing' => StaffAttendance::where('date', $date)->pluck('status', 'staff_id')->toArray(),
        ]);
    }

    public function staffSave(Request $request)
    {
        $request->validate(['date' => 'required|date', 'status' => 'required|array']);
        foreach ($request->status as $staffId => $status) {
            StaffAttendance::updateOrCreate(
                ['staff_id' => $staffId, 'date' => $request->date],
                ['status' => $status, 'note' => $request->input("note.$staffId")]
            );
        }
        return back()->with('success', 'Staff attendance saved for ' . $request->date);
    }

    public function staffReport(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);
        $rows = Staff::orderBy('name')->get()->map(function ($s) use ($month, $year) {
            $att = StaffAttendance::where('staff_id', $s->id)
                ->whereMonth('date', $month)->whereYear('date', $year)
                ->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');
            return ['staff' => $s, 'att' => $att];
        });
        return view('attendance.staff-report', ['rows' => $rows, 'month' => $month, 'year' => $year]);
    }

    protected function filters(Request $request): array
    {
        return [
            'classes'  => SchoolClass::orderBy('name')->pluck('name', 'id'),
            'sections' => Section::orderBy('name')->pluck('name', 'id'),
            'class_id'   => $request->class_id,
            'section_id' => $request->section_id,
            'subject_id' => $request->subject_id,
            'date' => $request->get('date', today()->toDateString()),
        ];
    }

    protected function students(Request $request)
    {
        return Student::where('status', 'active')
            ->where('class_id', $request->class_id)
            ->when($request->section_id, fn ($q) => $q->where('section_id', $request->section_id))
            ->orderBy('roll_no')->get();
    }
}
