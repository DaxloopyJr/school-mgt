<?php

namespace App\Http\Controllers;

use App\Models\GeneratedIdCard;
use App\Models\IdCard;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;

class IdCardController extends Controller
{
    public function generateForm(Request $request)
    {
        $students = collect();
        if ($request->filled('class_id')) {
            $students = Student::where('class_id', $request->class_id)
                ->when($request->section_id, fn ($q) => $q->where('section_id', $request->section_id))
                ->where('status', 'active')->orderBy('roll_no')->get();
        }
        return view('id-cards.generate', [
            'cards'    => IdCard::orderBy('name')->pluck('name', 'id'),
            'classes'  => SchoolClass::orderBy('name')->pluck('name', 'id'),
            'sections' => Section::orderBy('name')->pluck('name', 'id'),
            'students' => $students,
        ]);
    }

    public function generateSave(Request $request)
    {
        $request->validate(['id_card_id' => 'required', 'students' => 'required|array']);
        $card = IdCard::findOrFail($request->id_card_id);
        $generated = [];
        foreach ($request->students as $sid) {
            $generated[] = GeneratedIdCard::create([
                'student_id' => $sid,
                'id_card_id' => $card->id,
                'card_no'    => 'IDC-' . str_pad((string) (GeneratedIdCard::max('id') + 1), 5, '0', STR_PAD_LEFT),
                'date'       => today()->toDateString(),
            ]);
        }
        return redirect()->route('id-cards.print', $generated[0]->id)
            ->with('success', count($generated) . ' ID card(s) generated.');
    }

    public function printCard($id)
    {
        $gc = GeneratedIdCard::with(['student.schoolClass', 'student.section', 'card'])->findOrFail($id);
        return view('id-cards.print', ['gc' => $gc]);
    }
}
