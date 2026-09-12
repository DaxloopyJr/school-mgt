<?php

namespace App\Http\Controllers;

use App\Models\GeneratedCertificate;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentCertificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function generateForm(Request $request)
    {
        $students = collect();
        if ($request->filled('class_id')) {
            $students = Student::where('class_id', $request->class_id)
                ->when($request->section_id, fn ($q) => $q->where('section_id', $request->section_id))
                ->where('status', 'active')->orderBy('roll_no')->get();
        }
        return view('certificates.generate', [
            'certificates' => StudentCertificate::orderBy('name')->pluck('name', 'id'),
            'classes'      => SchoolClass::orderBy('name')->pluck('name', 'id'),
            'sections'     => Section::orderBy('name')->pluck('name', 'id'),
            'students'     => $students,
        ]);
    }

    public function generateSave(Request $request)
    {
        $request->validate(['certificate_id' => 'required', 'students' => 'required|array']);
        $cert = StudentCertificate::findOrFail($request->certificate_id);
        $generated = [];
        foreach ($request->students as $sid) {
            $generated[] = GeneratedCertificate::create([
                'student_id'             => $sid,
                'student_certificate_id' => $cert->id,
                'certificate_no'         => 'CERT-' . str_pad((string) (GeneratedCertificate::max('id') + 1), 5, '0', STR_PAD_LEFT),
                'date'                   => today()->toDateString(),
            ]);
        }
        return redirect()->route('certificates.print', $generated[0]->id)
            ->with('success', count($generated) . ' certificate(s) generated.');
    }

    public function printCertificate($id)
    {
        $gc = GeneratedCertificate::with(['student.schoolClass', 'student.section', 'certificate'])->findOrFail($id);
        return view('certificates.print', ['gc' => $gc]);
    }
}
