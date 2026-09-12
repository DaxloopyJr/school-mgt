<?php

namespace App\Http\Controllers;

use App\Models\UploadContent;
use Illuminate\Http\Request;

class StudyMaterialController extends Controller
{
    protected function listing(Request $request, string $type, string $title)
    {
        $user = $request->user();
        $q = UploadContent::with(['schoolClass', 'subject'])->where('content_type', $type)->latest('upload_date');

        if ($user->role === 'student' && $user->student) {
            $q->where(function ($sub) use ($user) {
                $sub->where('class_id', $user->student->class_id)->orWhereNull('class_id');
            });
        }

        return view('study-material.list', [
            'items' => $q->paginate(15)->withQueryString(),
            'title' => $title,
        ]);
    }

    public function assignments(Request $request) { return $this->listing($request, 'assignment', 'Assignments'); }
    public function materials(Request $request)   { return $this->listing($request, 'study_material', 'Study Material'); }
    public function syllabus(Request $request)    { return $this->listing($request, 'syllabus', 'Syllabus'); }
    public function downloads(Request $request)   { return $this->listing($request, 'other_download', 'Other Downloads'); }
}
