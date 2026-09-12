<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentManageController extends Controller
{
    public function promoteForm(Request $request)
    {
        $students = collect();
        if ($request->filled('class_id')) {
            $students = Student::with(['schoolClass', 'section'])
                ->where('class_id', $request->class_id)
                ->when($request->section_id, fn ($q) => $q->where('section_id', $request->section_id))
                ->where('status', 'active')->orderBy('roll_no')->get();
        }
        return view('students.promote', [
            'classes'  => SchoolClass::orderBy('name')->pluck('name', 'id'),
            'sections' => Section::orderBy('name')->pluck('name', 'id'),
            'students' => $students,
        ]);
    }

    public function promoteSave(Request $request)
    {
        $request->validate([
            'students'      => 'required|array',
            'new_class_id'  => 'required|exists:school_classes,id',
        ]);
        $count = Student::whereIn('id', $request->students)->update([
            'class_id'   => $request->new_class_id,
            'section_id' => $request->new_section_id,
        ]);
        return back()->with('success', $count . ' students promoted to the new class.');
    }

    public function disabled()
    {
        $students = Student::with(['schoolClass', 'section'])->where('status', 'disabled')->latest()->paginate(20);
        return view('students.disabled', ['students' => $students]);
    }

    public function toggleStatus($id)
    {
        $student = Student::findOrFail($id);
        $student->update(['status' => $student->status === 'active' ? 'disabled' : 'active']);
        return back()->with('success', 'Student ' . $student->fullName() . ' is now ' . $student->status . '.');
    }
}
